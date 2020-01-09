<?php
    $username = $_POST["uname"];
    $password = $_POST["pwd"];

    if(!isset($username) || !isset($password)) {
        $message = '<html><body><h2>Invalid credentials!</h2></body></html>';
    }
    else 
    {
        $xml = simplexml_load_file("credentials.xml");
        
        // First, check that a user with this username exists
        $query = '//User[username=\''.$username.'\']';
        $entries = $xml->xpath($query);

        foreach($entries as $entry)
        {
            //$stored_id = $entry->xpath('//User[username=\''.$username.'\']//id//text()');
            $stored_id = $entry->xpath("id");

            echo print_r($stored_id);

            //$stored_password[] = $entry->xpath('//User[username=\''.$username.'\'][id=\''.$stored_id.'\']//password//text()');
            $stored_password = $entry->xpath("password");
            echo print_r($stored_password);

            if($stored_password != $password)
            {
                 print_r($password);
                $message = '<html><body><h2>Invalid credentials!</h2></body></html>';
            }
            else
            {
                 print_r($password);
                $message = '<html><body><h2>Authorised!</h2></body></html>';
            }
        }
    }

    echo $message;
?>