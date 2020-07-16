<?php
	namespace Module;

	use Ratchet\MessageComponentInterface;
	use Ratchet\ConnectionInterface;

	class WS implements MessageComponentInterface {

		
		public function onCall( ConnectionInterface $conn, $id, $topic, array $params )
		{
            echo "New Call! ( {$conn->resourceId} ) \n";
		}

		public function onOpen( ConnectionInterface $conn )
		{
			echo "New connection! ( {$conn->resourceId} ) \n";
		}

		public function onMessage( ConnectionInterface $conn, $data )
		{
		    $data = json_decode( $data );

			switch ( $data->event ) {
                case "greeting" :
					$data_json = array(
						"event" => "reply",
						"msg"   => "hello too."
					);
					$conn->send( json_encode( $data_json ) );
				break;
				
				case "notification" :
					$data_json = array(
						"event" => "reply",
						"msg"   => $data->content
					);

					$conn->send( json_encode( $data_json ) );
                break;
			}
		}

		public function onClose( ConnectionInterface $conn )
		{
			echo "Connection {$conn->resourceId} has disconnected \n";
		}

		public function onError( ConnectionInterface $conn, \Exception $e ) {
			echo "An error has occurred: {$e->getMessage()} \n";

			$conn->close();
		}
	}