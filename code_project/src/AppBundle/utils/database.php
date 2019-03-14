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
    public function getMovieDetails() {
        $sql = $this->prepare(
            "select M.trailer_link, M.movie_title,
            group_concat (distinct strftime('%d-%m-%Y %H:%M', play_times_and_dates  )) as playList,
            AR.rateID,
            group_concat (distinct CC.classification_componentID) as classificationList,
            group_concat (distinct G.genre_name) as genreList,
            M.movie_length, M.release_year, M.synopsis,
            group_concat ( distinct L.language_name) as spokenlanguageList,
            group_concat ( distinct LA.language_name) as undertitlelanguageList,
            group_concat ( distinct D.director_firstname || ' ' || D.director_lastname) as directorsList,
            group_concat ( distinct A.actor_firstname || ' ' || A.actor_lastname) as actorsList
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
            where M.movieID = 2"
        );
        $res = $sql->execute();
        return array($res->fetchArray());
    }
}