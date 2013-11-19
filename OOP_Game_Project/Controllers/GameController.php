<?php

	class GameController
	{

		public function init_party()
		{
            global $template;
            $user1_name = $_POST['pseudo'][0];
            $user1_class = $_POST['classes'][0];
            $user2_name = $_POST['pseudo'][1];
            $user2_class = $_POST['classes'][1];
            if ($user1_name !== $user2_name)  { 	
	            if (($user1 = User::find(array('pseudo' => $user1_name))) === NULL) {
	                $user1 = new User(array('pseudo' => $user1_name));
	                $user1->save();
                    $user1_champ = new $user1_class();
	                $user1->add_collection($user1_champ, 'champions');
	                $user1->save_collections('champions');
	            }
	            else {
	                $user1->with('champions');
	            }
	            if (($user2 = User::Find(array('pseudo' => $user2_name))) === NULL) {
	                $user2 = new User(array('pseudo' => $user2_name));
	                $user2->save();
	                $user2_champ = new $user2_class();
	                $user2->add_collection($user2_champ, 'champions');
	                $user2->save_collections('champions');
	            } else {
	                $user2->with('champions');
	            }

	            $n = rand(1,2);
	            $alias = 'user'.$n;
	            $battle = new Battle(array('id_user_1' => $user1->id, 'id_user_2' => $user2->id, 'turn_is' => ${$alias}->id));
	            $battle->save();
	            $_SESSION['battle'] = $battle->id;
	            $template = 'battle';

            	return array('user1' => $user1, 'user2' => $user2, 'turn_is' => $battle->turn_is, "champion_user1" => $user1->get_collection('champions'), "champion_user2" => $user2->get_collection('champions'));
            } else {
            	header('location: index.php?action=home');
            }
		}

        public function action() {

            global $template;

            $id_battle = $_SESSION['battle'];
            $battle = new Battle(array('id' => $id_battle));
            $battle->users_in_battle();
            $id = $_POST['id_user'];
            $action = $_POST['method'];
            $template = 'battle';
            $end = $battle->round($id,$action);

            //return array('user1' => $battle->user_1, 'user2' => $battle->user_2, 'turn_is' => $battle->turn_is, "champion_user1" => $battle->user_1->get_collection('champions'), "champion_user2" => $battle->user_2->get_collection('champions'));
        }

        public function restart() {
            global $template;

            $id_battle = $_SESSION['battle'];
            $battle = new Battle(array('id' => $id_battle));
            $battle->users_in_battle();
            $id = $_POST['id_user'];

            $template = 'home';
        }
	}