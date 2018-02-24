<?php
    if (isset($_POST['search'])) {
        $keyword = $_POST['search'];
        $query   = select("SELECT song.id_song,title,username,picture FROM song,library,user,album WHERE library.id_song=song.id_song AND song.id_album=album.id_album AND library.id_user=user.u_id AND title LIKE '%$keyword%' ORDER BY title ASC");
        
        if (count($query) > 0) {
            echo 'Search results from title:';
            echo '<div class="results-container">';
            for ($i = 0; $i < count($query); $i++) {
                $song        = $query[$i][0];
                $title       = $query[$i][1];
                $username    = $query[$i][2];
                $pathPicture = $query[$i][3];
                
                printCardSearch($song, $title, $username, $pathPicture);
            }
            echo '</div>';
        }
        $query2 = select("SELECT username,name,surname,avatar,u_id FROM user WHERE username LIKE '%$keyword%' OR name LIKE '%$keyword%' OR surname LIKE '%$keyword%'");
        if (count($query2) > 0) {
            echo 'Search results from autor:';
            echo '<div class="results-container">';
            
            for ($i = 0; $i < count($query2); $i++) {
                $username = $query2[$i][0];
                $name     = $query2[$i][1];
                $surname  = $query2[$i][2];
                $avatar   = $query2[$i][3];
                $userID   = $query2[$i][4];
                
                echo '<a href="user.html?userID=' . $userID . '">';
                echo '<div class="result-card">';
                echo '<div class="result-card-title">' . $username . '</div>';
                echo '<img src="misc/img/users/' . $avatar . '" />';
                echo '<div class="result-card-title-sub">' . $name . '</div>';
                echo '<div class="result-card-title-sub">' . $surname . '</div>';
                echo '</div>';
                echo '</a>';
            }
            echo '</div>';
        }
        $query3 = select("SELECT * FROM album WHERE name LIKE '%$keyword%' ");
        if (count($query3) > 0) {
            echo 'Search results from album:';
            echo '<div class="results-container">';
            for ($i = 0; $i < count($query3); $i++) {
                $idAlbum = $query3[$i][0];
                $name    = $query3[$i][1];
                $picture = $query3[$i][2];
                
                //echo '<a href="user.html?userID='.$userID.'">';
                echo '<div class="result-card">';
                echo '<img src="misc/img/album-covers/' . $picture . '" />';
                echo '<div class="result-card-title">' . $name . '</div>';
                echo '</div>';
                //echo '</a>';
                
            }
            echo '</div>';
        }
    }
    
    if (isset($_POST['order'])) {
        $genre = $_POST['genre'];
        $sort  = $_POST['sort'];
        $order = $_POST['order'];
        
        $query = select("SELECT title,name,upload_date,download,id_album,id_song FROM song,genre WHERE song.genre=id_genre AND name='$genre' ORDER BY $sort $order");
        
        echo 'Songs in ' . $genre . ' genre sorted by ' . $sort . ' in ' . $order . ' order';
        
        echo '<div class="results-container">';
        for ($i = 0; $i < count($query); $i++) {
            $title       = $query[$i][0];
            //$genre = $query[$i][1];
            $upload_date = $query[$i][2];
            $download    = $query[$i][3];
            $album       = $query[$i][4];
            $song        = $query[$i][5];
            
            $getAlbumIMG = select("SELECT picture FROM album WHERE id_album='$album';");
            $pathPicture = $getAlbumIMG[0][0];
            
            echo '<a href="listen.html?id_song=' . $song . '">';
            echo '<div class="result-card">';
            echo '<img src="misc/img/album-covers/' . $pathPicture . '" />';
            echo '<div class="result-card-title">' . $title . '</div>';
            echo '<div class="result-card-title-sub">' . $download . ' downloads</div>';
            echo '<div class="result-card-title-sub">' . date_format(date_create($upload_date), "d/m/Y") . '</div>';
            echo '</div>';
            echo '</a>';
        }
        echo '</div>';
    }
?>