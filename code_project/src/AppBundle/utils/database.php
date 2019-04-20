<?php
namespace AppBundle\utils;
use SQLite3;
class database extends SQlite3
{
    public function __construct()
    {
        $path = '../web/db/DFS.db';
        $this->open($path);
    }
    public function getMovieDetails($id) {
        $seperateMovie = $this->prepare(
            "select M.trailer_link, M.movie_title,
            group_concat (distinct strftime('%d-%m-%Y %H:%M', play_times_and_dates  )) as playList,
            AR.rateID,
            group_concat (distinct CC.classification_componentID) as classificationList,
            group_concat (distinct G.genre_name) as genreList,
            M.movie_length, M.release_year, M.synopsis,
            GROUP_CONCAT ( DISTINCT ' '|| L.language_name) AS spokenlanguageList,
            GROUP_CONCAT ( DISTINCT ' '|| LA.language_name) AS undertitlelanguageList,
            GROUP_CONCAT ( DISTINCT ' '|| D.director_firstname || ' ' || D.director_lastname) AS directorsList,
            GROUP_CONCAT ( DISTINCT ' '|| A.actor_firstname || ' ' || A.actor_lastname) AS actorsList
            from Movies as M, Movies as X, Movies as Y
            join MovieShows as MS on Y.movieID = MS.movieID
            join AgeRates as AR on M.rating_ageID = AR.rateID
            join MovieClassificationComponents as MCC on M.movieID = MCC.movieID
            join ClassificationComponents as CC on CC.classification_componentID = MCC.classification_componentID
            join MovieGenres as MG on M.movieID = MG.movieID
            join Genres as G on G.genreID = MG.genreID
            left join MovieSpokenLanguages as ML on M.movieID = ML.movieID
            left join Languages as L on L.languageID = ML.languageID
            left join MovieUndertitleLanguages as MUL on X.movieID = MUL.movieID
            left join Languages as LA on LA.languageID = MUL.languageID
            left join MovieDirectors as MD on M.movieID = MD.movieID
            left join Directors as D on D.directorID = MD.directorID
            left join MovieActors as MA on M.movieID = MA.movieID
            left join Actors as A on A.actorID = MA.actorID
            where M.movieID = :id"
        );
        $seperateMovie->bindParam('id',$id);
        $resSeperateMovie = $seperateMovie->execute();
        return array($resSeperateMovie->fetchArray());
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
            "select  distinct M.movieID, M.movie_title from Movies as M
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
}