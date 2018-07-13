<?php

class Wiki {

	public function __construct( $db ) {
		$this->db = $db;
	}

	public function get_categories() {
		$query = $this->db->prepare( "SELECT * FROM categories ORDER BY naam ASC" );
		$query->execute();
		$count = $query->rowCount();

		$query = $query->fetchAll( PDO::FETCH_ASSOC );

		if ( $count > 0 ) {
			return $query;
		} else {
			return 'error';
		}
	}

	public function get_cat_name( $cat_id ) {
		$query = $this->db->prepare( "SELECT naam FROM categories WHERE id = :cat_id" );
		$query->bindValue( ':cat_id', $cat_id );
		$query->execute();
		$count = $query->rowCount();

		$query = $query->fetch( PDO::FETCH_ASSOC );

		if ( $count > 0 ) {
			return $query;
		} else {
			return 'error';
		}
	}

	public function get_subcategories( $cat_id ) {
		$query = $this->db->prepare( "SELECT * FROM subcategories WHERE cat_id = :cat_id" );
		$query->bindValue( ':cat_id', $cat_id );
		$query->execute();

		$count = $query->rowCount();

		$query = $query->fetchAll( PDO::FETCH_ASSOC );

		if ( $count > 0 ) {
			return $query;
		} else {
			return 'error';
		}
	}


	public function get_subcat_name( $sub_id ) {
		$query = $this->db->prepare( "SELECT naam FROM subcategories WHERE id = :sub_id" );
		$query->bindValue( ':sub_id', $sub_id );
		$query->execute();
		$count = $query->rowCount();

		$query = $query->fetch( PDO::FETCH_ASSOC );

		if ( $count > 0 ) {
			return $query;
		} else {
			return 'error';
		}
	}


	public function get_articles( $sub_id ) {
		$query = $this->db->prepare( "SELECT id,onderwerp FROM artikelen WHERE sub_id = :sub_id" );
		$query->bindValue( ':sub_id', $sub_id );
		$query->execute();

		$count = $query->rowCount();

		$query = $query->fetchAll( PDO::FETCH_ASSOC );

		if ( $count > 0 ) {
			return $query;
		} else {
			return 'error';
		}
	}

	public function get_article_content( $art_id ) {
		$query = $this->db->prepare( "SELECT * FROM artikelen WHERE id = :art_id" );
		$query->bindValue( ':art_id', $art_id );
		$query->execute();

		$count = $query->rowCount();

		$query = $query->fetch( PDO::FETCH_ASSOC );

		if ( $count > 0 ) {
			return $query;
		} else {
			return 'error';
		}
	}

	public function new_article( $cat, $sub_cat, $title, $content ) {
		try {
			$query = $this->db->prepare( "INSERT INTO artikelen (cat_id, sub_id, creator_id, onderwerp, bericht, aangepast, aangemaakt) VALUES 
(:cat_id, :sub_id, :creator_id, :onderwerp, :bericht, :aangepast, :aangemaakt)" );
			$query->bindValue( ':cat_id', $cat );
			$query->bindValue( ':sub_id', $sub_cat );
			$query->bindValue( ':creator_id', 1 );
			$query->bindValue( ':onderwerp', $title );
			$query->bindValue( ':bericht', $content );
			$query->bindValue( ':aangepast', date( 'Y-m-d H:i:s' ) );
			$query->bindValue( ':aangemaakt', date( 'Y-m-d H:i:s' ) );

			$query->execute();

			$result = array(
				'status'  => 'ok',
				'last_id' => $this->db->lastInsertId()
			);

			return $result;
		} catch ( PDOException $e ) {
			return $e->getMessage();
		}

	}

	public function edit_article( $id, $title, $content ) {
		try {
			$query = $this->db->prepare( "UPDATE artikelen SET onderwerp = :title, bericht = :content, aangepast = :aangepast WHERE id = :id" );
			$query->bindValue( ':title', $title );
			$query->bindValue( ':content', $content );
			$query->bindValue( ':aangepast', date( 'Y-m-d H:i:s' ) );
			$query->bindValue( ':id', $id );

			$query->execute();

			$result = array(
				'status'  => 'ok',
				'edit_id' => $id
			);

			return $result;
		} catch ( PDOException $e ) {
			return $e->getMessage();
		}

	}

	public function new_categorie( $titel ) {
		try {
			$query = $this->db->prepare( "INSERT INTO categories (naam) VALUES (:naam)" );
			$query->bindValue( ':naam', $titel );

			$query->execute();

			$result = array(
				'status'  => 'ok',
				'last_id' => $this->db->lastInsertId()
			);

			return $result;
		} catch ( PDOException $e ) {
			return $e->getMessage();
		}
	}

	public function edit_categorie( $id, $title ) {
		try {
			$query = $this->db->prepare( "UPDATE categories SET naam = :naam WHERE id = :id" );
			$query->bindValue( ':naam', $title );
			$query->bindValue( ':id', $id );

			$query->execute();

			$result = array(
				'status'  => 'ok',
				'edit_id' => $id
			);

			return $result;
		} catch ( PDOException $e ) {
			return $e->getMessage();
		}
	}

	public function new_subcategorie( $cat_id, $titel ) {
		try {
			$query = $this->db->prepare( "INSERT INTO subcategories (cat_id, naam) VALUES (:cat_id, :naam)" );
			$query->bindValue( ':cat_id', $cat_id );
			$query->bindValue( ':naam', $titel );

			$query->execute();

			$result = array(
				'status'  => 'ok',
				'last_id' => $this->db->lastInsertId()
			);

			return $result;
		} catch ( PDOException $e ) {
			return $e->getMessage();
		}
	}

	public function edit_subcategorie( $id, $title ) {
		try {
			$query = $this->db->prepare( "UPDATE subcategories SET naam = :naam WHERE id = :id" );
			$query->bindValue( ':naam', $title );
			$query->bindValue( ':id', $id );

			$query->execute();

			$result = array(
				'status'  => 'ok',
				'edit_id' => $id
			);

			return $result;
		} catch ( PDOException $e ) {
			return $e->getMessage();
		}
	}

	public function random_color() {
		$number = rand( 0, 5 );

		$colors = array(
			0 => 'default',
			1 => 'primary',
			2 => 'success',
			3 => 'info',
			4 => 'warning',
			5 => 'danger'
		);

		return $colors[ $number ];
	}

	public function add_log( $gebruiker_id, $beschrijving ) {
		$query = $this->db->prepare( "INSERT INTO logboekje(gebruiker, omschrijving, datum, ip) VALUES (:gebruiker, :omschrijving, :datum, :ip)" );
		$query->bindValue( ':gebruiker', $gebruiker_id );
		$query->bindValue( ':omschrijving', $beschrijving );
		$query->bindValue( ':datum', date( 'Y-m-d H:i:s' ) );
		$query->bindValue( ':ip', $_SERVER['REMOTE_ADDR'] );

		$query->execute();
	}

	public function search( $text ) {

		$query = $this->db->prepare( "SELECT * FROM artikelen WHERE onderwerp LIKE '%" . $text . "%' OR bericht LIKE '%" . $text . "%'" );
		$query->execute();
		$data = array();

		if ( $query->rowCount() > 0 ) {

			while ( $row = $query->fetch( PDO::FETCH_ASSOC ) ) {
				$data[] = array( "id" => $row['id'], "name" => $row['onderwerp'] );
			}

			return json_encode( $data );
		}

	}

	public function logged_in() {
		if ( isset( $_SESSION['user_session'] ) ) {
			return true;
		} else {
			return false;
		}
	}

	public function save_new_notification( $title, $message, $type ) {
		try {
			$query = $this->db->prepare( "INSERT INTO notifications (datetime, title,message, msgtype) VALUES (:datetime,:title,:message,:msgtype)" );
			$query->bindValue( ':datetime', date( 'Y-m-d H:i:s' ) );
			$query->bindValue( ':title', $title );
			$query->bindValue( ':message', $message );
			$query->bindValue( ':msgtype', $type );

			$query->execute();


			return $result;
		} catch ( PDOException $e ) {
			return $e->getMessage();
		}
	}


	public function get_new_notifications() {
		try {
			$query = $this->db->prepare( "SELECT * FROM notifications WHERE showmsg = 1 ORDER BY datetime ASC" );
			$query->execute();
			$count = $query->rowCount();

			$query = $query->fetchAll( PDO::FETCH_ASSOC );

			if ( $count > 0 ) {
				return $query;
			} else {
				$result = 'error';

				return $result;
			}
		} catch ( PDOException $e ) {
			return $e->getMessage();
		}
	}

	public function disable_notifcication($id){
		try {
			$query = $this->db->prepare("UPDATE notifications SET showmsg = 0 WHERE id= $id");
			$query->execute();
		} catch ( PDOException $e ) {
			return $e->getMessage();
		}

	}

	public function delete_cat($id){
		try {
			$query = $this->db->prepare( "DELETE FROM categories WHERE id = $id" );
			$query->execute();


			$result = array(
				'status' => 'ok',
			);

			return $result;

		} catch ( PDOException $e ) {
			return $e->getMessage();
		}
	}
}
