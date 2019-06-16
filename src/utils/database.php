<?php
namespace App\utils;
use SQLite3;
class database extends SQlite3
{
    public function __construct()
    {
        $path = '../var/data.db';
        $this->open($path);
    }
    public function getMovieDetails($id) {
        $seperateMovie = $this->prepare(
            "SELECT M.trailer_link, M.movie_title, 
            strftime('%d-%m-%Y %H:%M', play_times_and_dates) AS playList, 
            A.auditorium_name,
            AR.rateID, 
            GROUP_CONCAT (DISTINCT CC.classification_componentID) AS classificationList, 
            GROUP_CONCAT (DISTINCT G.genre_name) AS genreList, 
            M.movie_length, 
            M.release_year, 
            M.synopsis, 
            GROUP_CONCAT (DISTINCT ' ' || L.language_name) AS spokenlanguageList, 
            GROUP_CONCAT (DISTINCT ' ' || LA.language_name) AS undertitlelanguageList, 
            (D.director_firstname || ' ' || D.director_lastname) AS directors, 
            GROUP_CONCAT (DISTINCT ' ' || A.actor_firstname || ' ' || A.actor_lastname) AS actorsList 
            FROM Movies AS M, Movies AS X 
            JOIN MovieShows AS MS ON M.movieID = MS.movieID
            JOIN Auditoriums AS A
            ON MS.auditoriumID = A.auditoriumID
            JOIN AgeRates AS AR ON M.rating_ageID = AR.rateID 
            JOIN MovieClassificationComponents as MCC ON M.movieID = MCC.movieID 
            JOIN ClassificationComponents as CC ON CC.classification_componentID = MCC.classification_componentID 
            JOIN MovieGenres as MG ON M.movieID = MG.movieID 
            JOIN Genres as G ON G.genreID = MG.genreID 
            LEFT JOIN MovieSpokenLanguages as ML ON M.movieID = ML.movieID 
            LEFT JOIN Languages as L ON L.languageID = ML.languageID 
            LEFT JOIN MovieUndertitleLanguages as MUL ON X.movieID = MUL.movieID 
            LEFT JOIN Languages as LA ON LA.languageID = MUL.languageID 
            JOIN MovieDirectors as MD ON M.movieID = MD.movieID JOIN Directors as D ON D.directorID = MD.directorID 
            LEFT JOIN MovieActors as MA ON M.movieID = MA.movieID 
            LEFT JOIN Actors as A ON A.actorID = MA.actorID 
            WHERE M.movieID = :id and datetime(MS.play_times_and_dates)
            BETWEEN datetime('now','localtime', '2 hours')
            AND date('now','localtime','7 days')
            GROUP BY Directors, playList
            ORDER BY strftime('%Y-%m-%d%H:%M', play_times_and_dates);
            "
        );
        $seperateMovie->bindParam('id',$id);
        $resSeperateMovie = $seperateMovie->execute();
        $multiArray = array();
        while($row = $resSeperateMovie->fetchArray(SQLITE3_ASSOC)){
            array_push($multiArray,$row);
        }
        return $multiArray;

    }
    public function getMovieDates($id){
        $movieDates = $this->prepare(
            "SELECT strftime('%d-%m-%Y %Hu%M',play_times_and_dates) AS vertoningsdata FROM Movieshows AS MS
            JOIN Movies AS M
            ON M.MovieID = MS.MovieID
            WHERE (MS.MovieID = :id) AND (play_times_and_dates BETWEEN datetime('now','localtime', '2 hours') AND date('now','localtime','7 days'))
            ORDER BY play_times_and_dates"
        );
        $movieDates->bindParam('id',$id);
        $resmovieDates = $movieDates->execute();
        $multiArray = array();
        while($row = $resmovieDates->fetchArray(SQLITE3_ASSOC)){
            array_push($multiArray,$row);
        }
        return $multiArray;
    }
    public function getHomepageDetails(){
        $homepageQuery = $this->prepare(
            "SELECT DISTINCT M.movieID, M.movie_title from Movies as M
            join MovieShows as MS on
            M.movieID = MS.movieID
            where datetime(MS.play_times_and_dates)
            between datetime('now','localtime', '2 hours')
            and date('now','localtime','7 days')
            order by date(MS.play_times_and_dates), time (MS.play_times_and_dates)"
        );
        $resHomepageQuery = $homepageQuery->execute();
        $multiArray = array();
        while($row = $resHomepageQuery->fetchArray(SQLITE3_ASSOC)){
            array_push($multiArray,$row);
            }
        return $multiArray;
    }
    public function getMoviesByGenres(){
        $movieGenre = $this->prepare(
            "SELECT movieID as filmID, movie_title, GROUP_CONCAT(' '|| playList) AS playNextSevenDay 
            FROM (SELECT M.movieID, M.movie_title,
            strftime('%d-%m-%Y %H:%M', play_times_and_dates) AS playList
            FROM Movies AS M
            JOIN MovieGenres AS MG
            on M.movieID = MG.movieID
            JOIN Genres AS G
            on MG.genreID = G.genreID
            JOIN MovieShows AS MS
            ON M.movieID = MS.movieID
            WHERE G.genre_name = 'drama' AND 
            datetime(MS.play_times_and_dates) BETWEEN datetime('now','localtime', '2 hours') AND 
            date('now','localtime','7 days')
            ORDER BY Play_times_and_dates)
            GROUP BY filmID;"
        );
        $resMovieGenre = $movieGenre->execute();
        $multiArray = array();
        while($row = $resMovieGenre->fetchArray(SQLITE3_ASSOC)){
            array_push($multiArray,$row);
        }
        return $multiArray;

    }
    public function getGenres(){
        $genreQuery = $this->prepare(
            "SELECT DISTINCT G.genre_name FROM Genres AS G
            join MovieGenres AS MG
            on MG.genreID = G.genreID
            join Movies AS M
            on M.movieID = MG.movieID
            join MovieShows As MS
            on M.movieID = MS.movieID
            WHERE  datetime(MS.play_times_and_dates) BETWEEN datetime('now','localtime', '2 hours') AND date('now','localtime','7 days')
            GROUP BY G.genre_name;"
        );
        $resgenreQuery = $genreQuery->execute();
        $multiArray = array();
        while($row = $resgenreQuery->fetchArray(SQLITE3_ASSOC)){
            array_push($multiArray,$row);
        }
        return $multiArray;
    }
    public function getOverviewDates(){
        $dateQuery = $this->prepare(
        "SELECT STRFTIME('%d-%m-%Y',MS.play_times_and_dates)AS date,
        CASE 
        WHEN date(MS.play_times_and_dates) = date('now','localtime')
        THEN 'vandaag'
        WHEN date(MS.play_times_and_dates) = date('now','localtime','1 days')
        THEN 'morgen'
        WHEN date(MS.play_times_and_dates) = date('now','localtime','2 days')
        THEN 
        CASE 
        WHEN  strftime('%w',MS.play_times_and_dates) = '0'
        THEN 'zondag'
        WHEN  strftime('%w',MS.play_times_and_dates) = '1'
        THEN 'maandag'
        WHEN  strftime('%w',MS.play_times_and_dates) = '2'
        THEN 'dinsdag'
        WHEN  strftime('%w',MS.play_times_and_dates) = '3'
        THEN 'woensdag'
        WHEN  strftime('%w',MS.play_times_and_dates) = '4'
        THEN 'donderdag'
        WHEN  strftime('%w',MS.play_times_and_dates) = '5'
        THEN 'vrijdag'
        WHEN  strftime('%w',MS.play_times_and_dates) = '6'
        THEN 'zaterdag'
        WHEN  strftime('%w',MS.play_times_and_dates) = '7'
        THEN 'zondag'
        END
        WHEN date(MS.play_times_and_dates) = date('now','localtime','3 days')
        THEN
        CASE 
        WHEN  strftime ('%w',MS.play_times_and_dates) = '0'
        THEN 'zondag'
        WHEN  strftime ('%w',MS.play_times_and_dates) = '1'
        THEN 'maandag'
        WHEN  strftime ('%w',MS.play_times_and_dates) = '2'
        THEN 'dinsdag'
        WHEN  strftime ('%w',MS.play_times_and_dates) = '3'
        THEN 'woensdag'
        WHEN  strftime ('%w',MS.play_times_and_dates) = '4'
        THEN 'donderdag'
        WHEN  strftime ('%w',MS.play_times_and_dates) = '5'
        THEN 'vrijdag'
        WHEN  strftime ('%w',MS.play_times_and_dates) = '6'
        THEN 'zaterdag'
        WHEN  strftime ('%w',MS.play_times_and_dates) = '7'
        THEN 'zondag'
        END 
        WHEN date(MS.play_times_and_dates) = date('now','localtime','4 days')
        THEN
        CASE 
        WHEN  strftime ('%w',MS.play_times_and_dates) = '0'
        THEN 'zondag'
        WHEN  strftime ('%w',MS.play_times_and_dates) = '1'
        THEN 'maandag'
        WHEN  strftime ('%w',MS.play_times_and_dates) = '2'
        THEN 'dinsdag'
        WHEN  strftime ('%w',MS.play_times_and_dates) = '3'
        THEN 'woensdag'
        WHEN  strftime ('%w',MS.play_times_and_dates) = '4'
        THEN 'donderdag'
        WHEN  strftime ('%w',MS.play_times_and_dates) = '5'
        THEN 'vrijdag'
        WHEN  strftime ('%w',MS.play_times_and_dates) = '6'
        THEN 'zaterdag'
        WHEN  strftime ('%w',MS.play_times_and_dates) = '7'
        THEN 'zondag'
        END 
        WHEN date(MS.play_times_and_dates) = date('now','localtime','5 days')
        THEN
        CASE 
        WHEN  strftime ('%w',MS.play_times_and_dates) = '0'
        THEN 'zondag'
        WHEN  strftime ('%w',MS.play_times_and_dates) = '1'
        THEN 'maandag'
        WHEN  strftime ('%w',MS.play_times_and_dates) = '2'
        THEN 'dinsdag'
        WHEN  strftime ('%w',MS.play_times_and_dates) = '3'
        THEN 'woensdag'
        WHEN  strftime ('%w',MS.play_times_and_dates) = '4'
        THEN 'donderdag'
        WHEN  strftime ('%w',MS.play_times_and_dates) = '5'
        THEN 'vrijdag'
        WHEN  strftime ('%w',MS.play_times_and_dates) = '6'
        THEN 'zaterdag'
        WHEN  strftime ('%w',MS.play_times_and_dates) = '7'
        THEN 'zondag'
        END 
        WHEN date(MS.play_times_and_dates) = date('now','localtime','6 days')
        THEN
        CASE 
        WHEN  strftime ('%w',MS.play_times_and_dates) = '0'
        THEN 'zondag'
        WHEN  strftime ('%w',MS.play_times_and_dates) = '1'
        THEN 'maandag'
        WHEN  strftime ('%w',MS.play_times_and_dates) = '2'
        THEN 'dinsdag'
        WHEN  strftime ('%w',MS.play_times_and_dates) = '3'
        THEN 'woensdag'
        WHEN  strftime ('%w',MS.play_times_and_dates) = '4'
        THEN 'donderdag'
        WHEN  strftime ('%w',MS.play_times_and_dates) = '5'
        THEN 'vrijdag'
        WHEN  strftime ('%w',MS.play_times_and_dates) = '6'
        THEN 'zaterdag'
        WHEN  strftime ('%w',MS.play_times_and_dates) = '7'
        THEN 'zondag'
        END 
        ELSE 'fout'
        END dag
        FROM Movies AS M
        JOIN MovieShows AS MS
        ON M.movieID = MS.movieID
        where (datetime(MS.play_times_and_dates) 
        BETWEEN datetime('now','localtime', '2 hours') 
        AND date('now','localtime','7 days'))
        GROUP BY date(MS.play_times_and_dates);"
        );
        $resdateQuery = $dateQuery->execute();
        $multiArray = array();
        while($row = $resdateQuery->fetchArray(SQLITE3_ASSOC)){
            array_push($multiArray,$row);
        }
        return $multiArray;
    }
    public function getDirectorInfo($director){
        $directorQuery = $this->prepare(
        "SELECT Directors, DateOfBirth, PlaceOfBirth, DateOfDeath, PlaceOfDeath, GROUP_CONCAT(' '|| movie_title) AS MovieTitles
        FROM (SELECT (D. director_firstname || ' ' || D. director_lastname) AS Directors,
        strftime('%d-%m-%Y', D.date_of_birth) AS DateOfBirth,
        C1.city_name || ', ' || ST1.state_name || ', '|| CO1.country_name AS PlaceOfBirth,
        strftime('%d-%m-%Y', D.date_of_death) AS DateOfDeath,
        C2.city_name || ', ' || ST2.state_name || ', ' || CO2.country_name AS PlaceOfDeath,
        M.movie_title
        FROM Directors AS D
        LEFT JOIN Cities AS C1 ON
        D.place_of_birth = C1.id 
        LEFT JOIN Cities AS C2 ON
        D.place_of_death = C2.id
        LEFT JOIN States_Provinces_Departments AS ST1 ON
        C1.stateID = ST1.StateID
        LEFT JOIN  States_Provinces_Departments AS ST2 ON
        C2.stateID = ST2.StateID
        LEFT JOIN Countries AS CO1 ON
        ST1.countryID = CO1.countryID
        LEFT JOIN Countries AS CO2 ON
        ST2.countryID = CO2.countryID
        JOIN MovieDirectors AS MD ON
        D.directorID = MD.directorID
        JOIN Movies AS M ON
        MD.movieID = M.movieID
        WHERE (D.director_firstname || ' ' || D.director_lastname) = :director)
        GROUP BY Directors;"
        );
        $directorQuery->bindParam('director',$director);
        $resDirectorQuery = $directorQuery->execute();
        return $resDirectorQuery->fetchArray(SQLITE3_ASSOC);
    }
    public function getMoviesToday(){

    }
    public function getAuditoriumInfo($id,$datetime){
        $movieAuditoriumQuery = $this->prepare(
        "SELECT DISTINCT MS.movieID, MS.movie_showID, MS.play_times_and_dates AS moviedatetime, A.auditorium_name 
        FROM Auditoriums AS A
        JOIN MovieShows AS MS
        ON MS.auditoriumID = A.auditoriumID
        where MS.movieID = :id AND strftime('%d-%m-%Y %Hu%M',MS.play_times_and_dates) = :datetime;"
        );
        $movieAuditoriumQuery->bindParam('id',$id);
        $movieAuditoriumQuery->bindParam('datetime',$datetime);
        $resMovieAuditoriumQuery = $movieAuditoriumQuery->execute();
        return $resMovieAuditoriumQuery->fetchArray(SQLITE3_ASSOC);
    }
}
