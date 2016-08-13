<?php

class rechManager extends rech {

    private $_db;
    private $_accueilArray = array();

    public function __construct($db) {
        $this->_db = $db;
    }

    public function getdvdall($titre, $support, $realisateur) {
        try {
            $query = "SELECT * FROM dvdcat2 where titre={$titre} and support={$support} and realisateur={$realisateur}";

            $resultset = $this->_db->prepare($query);
            $resultset->execute();
        } catch (PDOException $e) {
            print $e->getMessage();
        }

        while ($data = $resultset->fetch()) {
            try {
                $_accueilArray[] = new cat($data);
            } catch (PDOException $e) {

                print $e->getMessage();
            }
        }
        return $_accueilArray;
    }

    public function getdvdts($titre, $support) {
        try {
            $query = "SELECT * FROM dvdcat2 where titre={$titre} and support={$support}";

            $resultset = $this->_db->prepare($query);
            $resultset->execute();
        } catch (PDOException $e) {
            print $e->getMessage();
        }

        while ($data = $resultset->fetch()) {
            try {
                $_accueilArray[] = new cat($data);
            } catch (PDOException $e) {

                print $e->getMessage();
            }
        }
        return $_accueilArray;
    }

    public function getjdvdtr($titre, $realisateur) {
        try {
            $query = "SELECT * FROM dvdcat2 where titre={$titre} and realisateur={$realisateur}";

            $resultset = $this->_db->prepare($query);
            $resultset->execute();
        } catch (PDOException $e) {
            print $e->getMessage();
        }

        while ($data = $resultset->fetch()) {
            try {
                $_accueilArray[] = new cat($data);
            } catch (PDOException $e) {

                print $e->getMessage();
            }
        }
        return $_accueilArray;
    }

    public function getdvdsr($support, $realisateur) {
        try {
            $query = "SELECT * FROM dvdcat2 where support={$support} and realisateur={$realisateur}";

            $resultset = $this->_db->prepare($query);
            $resultset->execute();
        } catch (PDOException $e) {
            print $e->getMessage();
        }

        while ($data = $resultset->fetch()) {
            try {
                $_accueilArray[] = new cat($data);
            } catch (PDOException $e) {

                print $e->getMessage();
            }
        }
        return $_accueilArray;
    }

    public function getdvdt($titre) {
        try {
            $query = "SELECT * FROM dvdcat2 where titre={$titre}";

            $resultset = $this->_db->prepare($query);
            $resultset->execute();
        } catch (PDOException $e) {
            print $e->getMessage();
        }

        while ($data = $resultset->fetch()) {
            try {
                $_accueilArray[] = new cat($data);
            } catch (PDOException $e) {

                print $e->getMessage();
            }
        }
        return $_accueilArray;
    }

    public function getdvds($support) {
        try {
            $query = "SELECT * FROM dvdcat2 where support={$support}";

            $resultset = $this->_db->prepare($query);
            $resultset->execute();
        } catch (PDOException $e) {
            print $e->getMessage();
        }

        while ($data = $resultset->fetch()) {
            try {
                $_accueilArray[] = new cat($data);
            } catch (PDOException $e) {

                print $e->getMessage();
            }
        }
        return $_accueilArray;
    }

    public function getdvdr($realisateur) {
        try {
            $query = "SELECT * FROM dvdcat2 where realisateur={$realisateur}";

            $resultset = $this->_db->prepare($query);
            $resultset->execute();
        } catch (PDOException $e) {
            print $e->getMessage();
        }

        while ($data = $resultset->fetch()) {
            try {
                $_accueilArray[] = new cat($data);
            } catch (PDOException $e) {

                print $e->getMessage();
            }
        }
        return $_accueilArray;
    }

}

?>
