<?php 
class Dashboard_Model extends Model {
    public function __construct()
    {
        parent::__construct(); 
    }
 
      public function getsubs() {
        return [$this->_get("subscribers " )[0], $this->_get("subscribers order by s_ID desc {$this->pagination()}" )[1] ];
    }
    
    public function users($id = '') {
        if (!empty($id)) {
            return $this->_get('users', 'id', [$id], 0 )[1];
        }
        return [$this->_get("users " )[0], $this->_get("users order by id desc {$this->pagination()}" )[1] ];
    }
    
    public function getlogs($max) {  
        return $this->_get('logs left join users on l_by = id ', '', [  ], true, " order by l_ID desc limit $max" )[1];
    }
    
    public function getcontacts($status = 'current', $id = '') { 
        if (!empty($id)) {
            return $this->_get('contactus   ', 'id', [ $id  ], false )[1];
        }  
        $data = [$this->_get("contactus ", 'status', [ $status  ] )[0], $this->_get("contactus ", 'status', [ $status  ], 1, "order by id desc {$this->pagination()} ")[1] ] ; 
         
        return $data;
    } 
    
    public function totalblogs() {
	$output = [];
        $blog = $this->_get("blog left join blog_categories on blog_ID=bc_ID order by blog_ID desc {$this->pagination()}")[1];
        foreach($blog as $row) {
            $row['blog_views'] = $this->_get('analytics', '( page_url REGEXP ? )', [ "/blog/" . preg_quote($row['blog_slug'], '/') . "(/|$|\\?)" ])[0];
            $output[] = $row; 
        }
        
        return [$this->_get("blog left join blog_categories on blog_ID=bc_ID ")[0], $output ];
	    
        //return [$this->_get("blog left join blog_categories on blog_ID=bc_ID ")[0], $this->_get("blog left join blog_categories on blog_ID=bc_ID order by blog_ID desc {$this->pagination()}")[1] ];
    }
    

    public function editpost($id) {
        return $this->_get('blog ', 'blog_ID', [ $id ], false)[1];
    }
    public function gettags($id) { 
        return [];
    }
  
    
    public function getCategories($ajax = null) {
        
	    return $this->_get('blog_categories')[1];
		
    }
    
    public function getsummaries() { 
    
        return [
            'users' => $this->_getmore('users', 'count(id)', 'id >', [0]),
            'contact'=>$this->_getmore('contactus', 'count(id)', 'id > ', [0]),
            'visits'=>$this->_getmore('analytics', 'count(id)', 'id > ', [0]),
            
            ];
    }
    private function allGames() { 
        $replacements = [
            'date'=>'created_at',
        ];
        $count = "(select count(*) from players p2 where p2.game_id = g.id )"; 
        $sql = "SELECT g.*,pl.answer_chosen as answer_chosen, choice_details, $count as total_players, is_winner, player_accepted_invitation
                    FROM games g
                    LEFT JOIN players pl ON pl.game_id = g.id
                    LEFT JOIN choices c ON pl.answer_chosen = c.id
                    WHERE 1=1  
        ";
        $wheres = '';
        $values = [];
        $orderBy = "ORDER BY g.id DESC";
        if (!empty($_GET['status'])) {
            $wheres .= "  AND status = ? ";
            $values[] = $_GET['status'];
        }
        if (!empty($_GET['orderby'])) {
            $explodeOrderBy = explode(':', $_GET['orderby']);
            if (! empty($replacements[$explodeOrderBy[0]])) 
                $orderBy = " ORDER BY {$replacements[$explodeOrderBy[0]]} " . ($explodeOrderBy[1] ?? 'ASC');
        }
        if (!empty($_GET['gameType'])) {
            $wheres .= "  AND game_type = ? ";
            $values[] = $_GET['gameType'];
        }

        $games = $this->_query("$sql $wheres $orderBy {$this->pagination()}", $values )[1] ?? [];
         

        return [
            'data'=>$games,
            'count'=>$this->_query("$sql ", [ ] )[0]
        ];
    }

    public function profitsAndStats() {
        //
        $dateLimit = $_GET['limiter'] ?? '';
        $createdAtInterval = '1=1';
        switch ($dateLimit) {
            case 'today':
                $createdAtInterval = "created_at >= CURDATE() - INTERVAL 1 DAY";
                break;
            default: //all
                $digits = preg_replace('/[^0-9]/', '', $dateLimit);
                $createdAtInterval = "created_at >= CURDATE() - INTERVAL $digits DAY";
                if (($dateLimit === 'all') || (empty($digits)) ) $createdAtInterval = '1=1';
                break;
        }

      // non completed
        $sql = "SELECT SUM(stake_cost) AS totalEscrowVolt, count(g.id) as totalGames
                FROM games g
                WHERE (g.status = ? || g.status = ? || g.status = ? ) AND winning_choice != 1
                AND $createdAtInterval
                ";
        $values = ['pending', 'in_progress', 'completed']; 
        $totalEscrowVolt = $this->_query($sql, $values )[1]??[];
        
        //revenue
        $sql = "SELECT SUM(amount) AS totalRevenue  FROM revenues  WHERE $createdAtInterval ";
        $values = []; 
        $totalRevenue = $this->_query($sql, $values )[1]??[];

        //disputed
        $sql = "SELECT count(id) AS disputedGames, SUM(stake_cost) AS disputedAmounts  FROM games  WHERE status=? AND $createdAtInterval ";
        $values = ['disputed']; 
        $disputed = $this->_query($sql, $values )[1]??[];

        //total users
        $sql = "SELECT count(id) AS totalUsers FROM users  WHERE $createdAtInterval ";
        $values = [ ]; 
        $totalUsers = $this->_query($sql, $values )[1]??[];

        //all games
        $sql = "SELECT * FROM games  WHERE $createdAtInterval ";
        $values = [ ]; 
        $allGames = $this->_query($sql, $values )[1]??[];


        return [
            'totalEscrowVolt'=>$totalEscrowVolt,
            'totalRevenue'=>$totalRevenue,
            'disputed'=>$disputed,
            'totalUsers'=>$totalUsers,
            'allGames'=>$allGames,
        ];

    }

    public function gamesReports($page = null) {
        if (!$page) return;

        switch ($page) {
            case 'index':
                return $this->allGames(); 
            case 'profits':
                return $this->profitsAndStats();             
            default:
                return []; 
        }
        
    }

    public function withdrawalReports($page = null) {

     $replacements = [
            'date'=>'created_at',
        ]; 
        $sql = "SELECT dr.*, user_email, username
                    FROM deposit_request dr
                    LEFT JOIN users u ON u.id = dr.user_id 
                    WHERE is_withdrawal = 1
        ";
        $wheres = '';
        $values = [ ];
        $orderBy = "ORDER BY dr.id DESC";
        if (!empty($_GET['status'])) {
            $wheres .= "  AND status = ? ";
            $values[] = $_GET['status'];
        }
        if (!empty($_GET['orderby'])) {
            $explodeOrderBy = explode(':', $_GET['orderby']);
            if (! empty($replacements[$explodeOrderBy[0]])) 
                $orderBy = " ORDER BY {$replacements[$explodeOrderBy[0]]} " . ($explodeOrderBy[1] ?? 'ASC');
        }
       

        $wdrawals = $this->_query("$sql $wheres $orderBy {$this->pagination()}", $values )[1] ?? [];
         

        return [
            'data'=>$wdrawals,
            'count'=>$this->_query("$sql ", [ ] )[0]
        ];

    }
 
     





    ///////////////////
}

