<?php

require '../config.php';
include '../model/test.php';


class testC
{

    public function listtest()
    {
        $sql = "SELECT * FROM test";
        $db = config::getConnexion();
        try {
            $test = $db->query($sql);
            return $test;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deletetest($ide)
    {
        $sql = "DELETE FROM test WHERE id = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $ide);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }


    function addtest($test)
    {
        $sql = "INSERT INTO test 
        VALUES (NULL, :score_min, :score_max,:date,:duree)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'score_min' => $test->getscore_min(),
                'score_max' => $test->getscore_max(),
                'date' => $test->getdate(),
                'duree' => $test->getduree(),
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    function showtest($id)
    {
        $sql = "SELECT * from test where id = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $test = $query->fetch();
            return $test;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function updatetest($test, $id)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE test SET 
                    score_min = :score_min, 
                    score_max = :score_max, 
                    date = :date, 
                    duree = :duree
                WHERE id= :id'
            );

            $query->execute([
                'id' => $id,
                'score_max' => $test->getscore_max(),
                'score_min' => $test->getscore_min(),
                'date' => $test->getdate(),
                'duree' => $test->getduree(),
            ]);

            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
    public function trierscore_max()
                {
                    $sql = "SELECT * FROM test ORDER BY score_max DESC";
                    $db = config::getConnexion();
                    try {
                        $test = $db->query($sql);
                        return $test;
                    } catch (Exception $e) {
                        die('Error:' . $e->getMessage());
                    }
                }
    public function trierduree()
                {
                    $sql = "SELECT * FROM test ORDER BY duree DESC";
                    $db = config::getConnexion();
                    try {
                        $test = $db->query($sql);
                        return $test;
                    } catch (Exception $e) {
                        die('Error:' . $e->getMessage());
                    }
                }
    public function rechercherFormationParid($id) {
                    $sql = "SELECT * FROM test WHERE id LIKE :id";
                    $db = config::getConnexion();
            
                    try {
                        $query = $db->prepare($sql);
                        $query->execute(array(':id' => "%$id%")); // Utilise le joker % pour rechercher les correspondances partielles du id
                        $result = $query->fetchAll();
                        return $result;
                    } catch (PDOException $e) {
                        echo 'Erreur: ' . $e->getMessage();
                        return array(); // Retourne un tableau vide en cas d'erreur
                    }
                }
        
                } 
        /*public function addPdfFile($fileInfo) {
                    $sql = "INSERT INTO pdf_files (name, size, type) VALUES (:name, :size, :type)";
                    $db = config::getConnexion();
                    try {
                        $query = $db->prepare($sql);
                        $query->execute([
                            'name' => $fileInfo['name'],
                            'size' => $fileInfo['size'],
                            'type' => $fileInfo['type']
                        ]);
                        echo "File info inserted successfully.";
                    } catch (PDOException $e) {
                        echo 'Error: ' . $e->getMessage();
                    }
                }*/
                
   

?>
