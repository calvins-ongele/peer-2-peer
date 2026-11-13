<?php
class Games_Model extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function fetchPublicGames() { 
        //$games = $this->_get('games', 'game_type', [ 'public' ], 1)[1];

         $count = "(select count(*) from players p2 where p2.game_id = g.id )"; 
        $sql = "SELECT g.*,pl.answer_chosen as answer_chosen, choice_details, $count as total_players
                    FROM games g
                    LEFT JOIN players pl ON pl.game_id = g.id
                    LEFT JOIN choices c ON pl.answer_chosen = c.id
                    WHERE g.game_type = 'public'
                   
        ";
        $games = $this->_query("$sql {$this->pagination()}", [  ] )[1] ?? [];
         
        return [
            'data'=>$games, 
            'count'=>$this->_get('games', 'game_type', [ 'public' ], 1)[0]
        ];

    }
    
    public function gameDetails($url = null) {
        if ($url) {
            $game = $this->_get('games', 'game_url', [$url], 0)[1];
            if (empty($game)) return;   
            $sql = "SELECT players.*, choice_details, is_winning_choice, username
                        FROM players
                        LEFT JOIN users u ON u.id = player_user_id
                        LEFT JOIN choices c ON c.id = players.answer_chosen
                        WHERE players.game_id = ?
                    ";
            $players = $this->_query($sql, [ $game['id'] ])[1]??[];//$this->_get('players', 'game_id', [ $game['id'] ])[1];
 
            return [
                'game'=>$game,
                'players'=>$players,
                'choices'=>$this->_get('choices', 'game_id', [ $game['id'] ])[1]
            ];
        }
        return [];
    }











}
