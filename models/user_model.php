<?php
class User_Model extends Model
{

    public function __construct()
    {
        parent::__construct();
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

            $me = $this->me();

            // is it my game
            if ($game['game_type'] === 'private') { //public should be open to anyone
                if ($game['created_by'] !== $me['id'] ) { //I dont own it
                    // check if I play at least
                    $iplay = array_filter($players, fn($r)=>($r['player_user_id']??'')===$me['id'] );
                    if (count($iplay) === 0) return; // I dont play nor was invited
                }
            }

            return [
                'game'=>$game,
                'players'=>$players,
                'choices'=>$this->_get('choices', 'game_id', [ $game['id'] ])[1]
            ];
        }
        return [];
    }









}
