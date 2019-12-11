<?php

function show($connection, $table)
{

//    $data = array();
//
//    if (($connection->query($sqlShow)) != NULL) {
//        $i = 0;
//        foreach ($connection->query($sqlShow) as $row) {
//            $data[$i] = $row;
//            $i++;
//        }
//
//    }
    $sql_show = "SELECT * FROM ".$table;
    $statement = $connection->prepare($sql_show);
    $statement->execute();
    $data = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $data;
}

function request($connection, $table, $inputs)
{
    $pow = NULL;
    foreach ($inputs as $key => $value)
    {
        $pow.= $key;
        $pow.= ',';
    }
    $pow = substr($pow, 0, -1);



    $row = NULL;
    foreach ($inputs as $key => $value)
    {
         $row.= ':';
         $row.= $key;
         $row.= ',';
    }
    $row = substr($row, 0, -1);




    $query = 'INSERT INTO '.$table.' ('.$pow.') '.' VALUES ('.$row.')';

    $statement = $connection->prepare($query);
    $statement->execute($inputs);

}

function deletefile($directory, $name_file)
{
    $dir = opendir($directory);


    while(($file = readdir($dir)))
    {
        if((is_file("$directory/$file")) && ("$directory/$file" == "$directory/".$name_file))
        {

            unlink("$directory/".$name_file);

        }
    }

    closedir($dir);

}

function delete_film($connection, $id_film_del)
{

    $sql_check = "SELECT * FROM table_cinema_films WHERE film_id=" . $id_film_del;

    if (($connection->query($sql_check) !== NULL))
    {
                $count = 0;
                foreach ($connection->query($sql_check) as $row) {
                    $count++;
                }


            if ($count == 0)
            {

                $value = ['id_film_del' => $id_film_del];

                $sql_file = "SELECT file FROM films WHERE id = " . $id_film_del;
                $result = $connection->query($sql_file);
                $temp = $result->fetch();
                $name_file = $temp['file'];

                $sql_del_film = 'DELETE FROM films WHERE id = :id_film_del';

                $statement = $connection->prepare($sql_del_film);
                $statement->execute($value);

                $directory = "D:\/test\sample.test\_www\uploads";


                deletefile($directory, $name_file);

                return true;
            }


    else return false;

    }
}

function add_file($connection, $work)
{


        $sql = "UPDATE films SET file=:file_name WHERE namefilm = :namefilm";
        $statement = $connection->prepare($sql);
        $statement->execute($work);

        $tmp_name = $_FILES['image']['tmp_name'];
        move_uploaded_file($tmp_name, "uploads/" . $work['file_name']);

}

function render_index($data)
{

        for($i = 0; $i < count($data); $i++)
        {  $url_params_film = "all_cinema_for_film.php?id_film=".$data[$i]['id'];

           echo '<div class="row justify-content-center" id="table">';

            foreach ($data[$i] as $row) {
                if (($row !== $data[$i]['id']) AND ($row !== $data[$i]['file'])) {

                    echo '<div class="col item-table font-style">
                    <div class="row align-items-center justify-content-center family">
                        <div class="col"><a href="' . $url_params_film . '">' . $row . '</a></div>
                    </div>
                 </div>';

                }
            }

            echo
                '<div class="col item-table font-style" style="height: inherit;">
                  
                  <img style=" height: inherit; width: inherit; object-fit: cover" src="uploads/'. $data[$i]['file'].'" alt="">
                  
                </div>
            
                <div class="col item-table font-style" style="height: inherit;">
                                     <div class="row align-items-center justify-content-center family">
                                         <div class="col"> <button class="btn-danger btn_del_film" data-id="'.$data[$i]['id'].'">Удалить</button></div>
                                     </div>
                </div>
                </div>';

        }
}

function render_add_film($data, $id_cinema)
{

    for($i = 0; $i < count($data); $i++) {
        $url_params = "add_film_into_cinema.php?id_film=".$data[$i]['id'].'&mas_pos='.$i."&action=add"."&id_cinema=".$id_cinema;

        echo '<div class="row justify-content-center" id="table">';

        foreach ($data[$i] as $row)
        {
            if (($row !== $data[$i]['id']) AND ($row !== $data[$i]['file']))
            {

                echo '<div class="col item-table font-style">
                                 <div class="row align-items-center justify-content-center family">
                                      <div class="col"><a href="' . $url_params . '">' . $row . '</a></div>
                                 </div>
                      </div>';
            }
        }

        echo
                      '<div class="col item-table font-style" style="height: inherit;">                  
                               <img style=" height: inherit; width: inherit; object-fit: cover" src="uploads/' . $data[$i]['file'] . '">              
                       </div> 
              </div>';


    }
}

function render_cinema($data)
{
    foreach ($data as $row) {
        $urlParams = "all_film_for_cinema.php?id_cinema=" . $row['id'];

        echo '<div class="row justify-content-center" id="table">
   
                    <div class="col item-table font-style">
                        <div class="row align-items-center justify-content-center family">
                            <div class="col"><a href="' . $urlParams . '">' . $row['name'] . '</a></div>
                        </div>
                    </div>
                    <div class="col item-table font-style" style="height: inherit;">
                        <div class="row align-items-center justify-content-center family" style="height: inherit;">
                            <div class="col">' . $row['address'] . '</div>
                        </div>
                    </div>

             </div>';
    }

}

