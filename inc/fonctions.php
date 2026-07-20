<?php 
    include("connexion.php");

    function get_all_lines($sql){
        $req = mysqli_query(dbconnect(),$sql );
        $result = array();
        while ($line = mysqli_fetch_assoc($req)) {
            $result[] = $line;
        }
        mysqli_free_result($req);
        // echo $sql;
        return $result;
    }

    function get_one_line($sql){
        $req = mysqli_query(dbconnect(), $sql);
        if (!$req) return null; // Retourne null si la requête échoue
    
        $result = mysqli_fetch_assoc($req);
        mysqli_free_result($req);
        return $result;
    }

    function est_dans_la_base($numero_etu)
    {
        $all_membre=get_all_member();
        foreach($all_membre as $membre){
            if($membre['numero_etu'] != $numero_etu){
    
            }
        }
    }
?>
