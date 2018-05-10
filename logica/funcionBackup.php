<?php

/* backup the db OR just a table */
//En la variable $talbes puedes agregar las tablas especificas separadas por comas:
//profesor,estudiante,clase
//O déjalo con el asterisco '*' para que se respalde toda la base de datos

function backup_tables($host,$user,$pass,$name,$tables = '*')
{
      $return='';
      $link = new mysqli($host,$user,$pass,$name);
     // mysql_select_db($name,$link);
      
      //get all of the tables
      if($tables == '*')
      {
         $tables = array();
         $result = $link->query('SHOW TABLES');
         while($row = mysqli_fetch_row($result))
         {
            $tables[] = $row[0];
         }
      }
      else
      {
         $tables = is_array($tables) ? $tables : explode(',',$tables);
      }
   
   //cycle through
   foreach($tables as $table)
   {
      //$return.= 'DROP TABLE '.$table.';';
      $row2 = mysqli_fetch_row($link->query('SHOW CREATE TABLE '.$table));
      $return.= "\n\n".$row2[1].";\n\n";
   }

      foreach($tables as $table)
      { 
         $result = $link->query('SELECT * FROM '.$table);
         $num_fields = mysqli_num_fields($result);

         if($table=="alumno")
         {
            for ($i = 0; $i < $num_fields; $i++)
            {
               while($row = mysqli_fetch_row($result))
               {
                  $return.= 'INSERT INTO '.$table.' (apellido,nombre,dni,fechaNacimiento,direccion,email,lugarNacimiento) VALUES(';
                  //$return.= 'INSERT INTO '.$table.' VALUES(';
                  for($j=0; $j<$num_fields-1; $j++) 
                  {
                     $row[$j] = addslashes($row[$j]);
                     $row[$j] = preg_replace("/\n/","\\n",$row[$j]);
                     if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
                     if ($j<($num_fields-2)) { $return.= ','; }
                  }
                  $return.= ");\n";
               }
            }
         }
         else
         {
                for ($i = 0; $i < $num_fields; $i++)
                  {
                     while($row = mysqli_fetch_row($result))
                     {
                        $return.= 'INSERT INTO '.$table.' VALUES(';
                        for($j=0; $j<$num_fields; $j++) 
                        {
                           $row[$j] = addslashes($row[$j]);
                           $row[$j] = preg_replace("/\n/","\\n",$row[$j]);
                           if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
                           if ($j<($num_fields-1)) { $return.= ','; }
                        }
                        $return.= ");\n";
                     }
                  }
         }  

         $return.="\n\n\n";
      }
      $fecha=date("Y-m-d");
      //save file
      /*
      $handle = fopen('backups/db-backup-'.$fecha.'.sql','w+');
       fwrite($handle,$return);
       fclose($handle);*/


      $sendto = "Webmaster <karenariananavarroo@gmail.com>";
      $sendfrom = "Automated Backup <institutonuestrasenora@gmail.com>";
      
      $headers = "MIME-Version: 1.0\r\n"; 
      $headers .= "Content-type: text/csv; charset=iso-8859-1\r\n"; 
      //dirección del remitente 
      $headers .= "Webmaster <karenariananavarroo@gmail.com>r\n";

       $enviado = mail("institutonuestrasenora@gmail.com","Backup-".$fecha,$return,$headers,"karenariananavarroo@gmail.com");


}