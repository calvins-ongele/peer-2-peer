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

    public function gamesReports($page = null) {
        if (!$page) return;

        switch ($page) {
            case 'index':
                return $this->allGames(); 
            
            default:
                # code...
                break;
        }
        
    }
 
     





    ///////////////////
}

