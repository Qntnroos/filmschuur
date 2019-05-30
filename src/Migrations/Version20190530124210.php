<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190530124210 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE Actors');
        $this->addSql('DROP TABLE AdditionalPriceReasons');
        $this->addSql('DROP TABLE AgeRates');
        $this->addSql('DROP TABLE Auditoriums');
        $this->addSql('DROP TABLE Cities');
        $this->addSql('DROP TABLE ClassificationComponents');
        $this->addSql('DROP TABLE Countries');
        $this->addSql('DROP TABLE Currencies');
        $this->addSql('DROP TABLE CurrencyCountries');
        $this->addSql('DROP TABLE DatabaseVersion');
        $this->addSql('DROP TABLE Directors');
        $this->addSql('DROP TABLE Genres');
        $this->addSql('DROP TABLE Languages');
        $this->addSql('DROP TABLE MovieActors');
        $this->addSql('DROP TABLE MovieClassificationComponents');
        $this->addSql('DROP TABLE MovieCountries');
        $this->addSql('DROP TABLE MovieDirectors');
        $this->addSql('DROP TABLE MovieGenres');
        $this->addSql('DROP TABLE MovieShowingSeats');
        $this->addSql('DROP TABLE MovieShows');
        $this->addSql('DROP TABLE MovieSpokenLanguages');
        $this->addSql('DROP TABLE MovieUndertitleLanguages');
        $this->addSql('DROP TABLE Movies');
        $this->addSql('DROP TABLE Noshows');
        $this->addSql('DROP TABLE Prices');
        $this->addSql('DROP TABLE Roles');
        $this->addSql('DROP TABLE Seats');
        $this->addSql('DROP TABLE States_Provinces_Departments');
        $this->addSql('DROP TABLE TicketOrderlines');
        $this->addSql('DROP TABLE Tickets');
        $this->addSql('DROP TABLE Users');
        $this->addSql('CREATE TEMPORARY TABLE __temp__Genders AS SELECT genderID, gender_name, gender_abbreviation FROM Genders');
        $this->addSql('DROP TABLE Genders');
        $this->addSql('CREATE TABLE Genders (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, gender_name VARCHAR(18) NOT NULL COLLATE BINARY, gender_abbreviation VARCHAR(1) NOT NULL COLLATE BINARY)');
        $this->addSql('INSERT INTO Genders (id, gender_name, gender_abbreviation) SELECT genderID, gender_name, gender_abbreviation FROM __temp__Genders');
        $this->addSql('DROP TABLE __temp__Genders');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, email, password, roles, user_firstname, user_lastname, user_adress, gender_id, phone, birthday FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, gender_id INTEGER NOT NULL, email VARCHAR(180) NOT NULL COLLATE BINARY, password VARCHAR(255) NOT NULL COLLATE BINARY, roles CLOB NOT NULL --(DC2Type:json)
        , user_firstname VARCHAR(60) NOT NULL, user_lastname VARCHAR(60) NOT NULL, user_adress VARCHAR(60) NOT NULL, phone VARCHAR(15) NOT NULL, birthday DATE NOT NULL, CONSTRAINT FK_8D93D649708A0E0 FOREIGN KEY (gender_id) REFERENCES genders (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO user (id, email, password, roles, user_firstname, user_lastname, user_adress, gender_id, phone, birthday) SELECT id, email, password, roles, user_firstname, user_lastname, user_adress, gender_id, phone, birthday FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        $this->addSql('CREATE INDEX IDX_8D93D649708A0E0 ON user (gender_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE Actors (actorID INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, actor_firstname VARCHAR(60) DEFAULT NULL COLLATE BINARY, actor_lastname VARCHAR(60) DEFAULT NULL COLLATE BINARY, created_date DATETIME DEFAULT NULL, updated_date DATETIME DEFAULT NULL, created_admin_userID INTEGER DEFAULT NULL, updated_admin_userID INTEGER DEFAULT NULL)');
        $this->addSql('CREATE TABLE AdditionalPriceReasons (AdditionalID INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, Additional_reason VARCHAR(20) NOT NULL COLLATE BINARY, created_date DATETIME NOT NULL, updated_date DATETIME DEFAULT NULL, created_admin_user_ID INTEGER DEFAULT NULL, updated_admin_user_ID INTEGER DEFAULT NULL)');
        $this->addSql('CREATE TABLE AgeRates (rateID INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, rate_age VARCHAR(2) NOT NULL COLLATE BINARY, created_date DATETIME NOT NULL, updated_date DATETIME DEFAULT NULL, created_admin_userID INTEGER DEFAULT NULL, updated_admin_userID INTEGER DEFAULT NULL)');
        $this->addSql('CREATE TABLE Auditoriums (auditoriumID INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, auditorium_name VARCHAR(20) NOT NULL COLLATE BINARY, seats_available INTEGER DEFAULT NULL, created_date DATETIME NOT NULL, updated_date DATETIME DEFAULT NULL, created_admin_userID INTEGER DEFAULT NULL, updated_admin_userID INTEGER DEFAULT NULL)');
        $this->addSql('CREATE TABLE Cities (cityID INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, postal_code VARCHAR(10) DEFAULT NULL COLLATE BINARY, city_name VARCHAR(85) NOT NULL COLLATE BINARY, stateID INTEGER NOT NULL, created_date DATETIME NOT NULL, updated_date DATETIME DEFAULT NULL, created_admin_userID INTEGER DEFAULT NULL, updated_admin_userID INTEGER DEFAULT NULL)');
        $this->addSql('CREATE TABLE ClassificationComponents (classification_componentID INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, classification_component_name VARCHAR(20) NOT NULL COLLATE BINARY, classification_icon_link CLOB DEFAULT NULL COLLATE BINARY, created_date DATETIME NOT NULL, updated_date DATETIME DEFAULT NULL, created_admin_userID INTEGER DEFAULT NULL, updated_admin_userID INTEGER DEFAULT NULL)');
        $this->addSql('CREATE TABLE Countries (countryID INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, country_name VARCHAR(60) NOT NULL COLLATE BINARY, country_IS0 VARCHAR(2) NOT NULL COLLATE BINARY, country_NIS INTEGER NOT NULL, created_date DATETIME NOT NULL, updated_date DATETIME DEFAULT NULL, created_admin_userID INTEGER DEFAULT NULL, updated_admin_userID INTEGER DEFAULT NULL)');
        $this->addSql('CREATE TABLE Currencies (currencyID INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, currency_name VARCHAR(30) NOT NULL COLLATE BINARY, ISO-code VARCHAR(3) NOT NULL COLLATE BINARY, updated_date DATETIME NOT NULL, created_date DATETIME DEFAULT NULL, created_admin_userID INTEGER DEFAULT NULL, updated_admin_userID INTEGER DEFAULT NULL)');
        $this->addSql('CREATE TABLE CurrencyCountries (currencyID INTEGER NOT NULL, countryID INTEGER NOT NULL, created_date DATETIME NOT NULL, updated_date DATETIME DEFAULT NULL, created_admin_user_ID INTEGER DEFAULT NULL, updated_admin_user_ID INTEGER DEFAULT NULL)');
        $this->addSql('CREATE TABLE DatabaseVersion (versionID INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, created_date DATETIME DEFAULT NULL, updated_date DATETIME DEFAULT NULL, created_admin_userID INTEGER DEFAULT NULL, updated_admin_userID INTEGER DEFAULT NULL)');
        $this->addSql('CREATE TABLE Directors (directorID INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, director_firstname VARCHAR(30) NOT NULL COLLATE BINARY, director_lastname VARCHAR(60) NOT NULL COLLATE BINARY, date_of_birth DATE DEFAULT NULL, place_of_birth INTEGER DEFAULT NULL, date_of_death DATE DEFAULT NULL, place_of_death INTEGER DEFAULT NULL, created_date DATETIME NOT NULL, updated_date DATETIME DEFAULT NULL, created_admin_userID INTEGER DEFAULT NULL, updated_admin_userID INTEGER DEFAULT NULL)');
        $this->addSql('CREATE TABLE Genres (genreID INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, genre_name VARCHAR(30) NOT NULL COLLATE BINARY, created_date DATETIME NOT NULL, updated_date DATETIME DEFAULT NULL, created_admin_userID INTEGER DEFAULT NULL, updated_admin_userID INTEGER DEFAULT NULL)');
        $this->addSql('CREATE TABLE Languages (languageID INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, language_name VARCHAR(60) NOT NULL COLLATE BINARY, language_ISO639_2_code VARCHAR(3) NOT NULL COLLATE BINARY, created_date DATETIME DEFAULT NULL, updated_date DATETIME DEFAULT NULL, created_admin_userID INTEGER DEFAULT NULL, updated_admin_userID INTEGER DEFAULT NULL)');
        $this->addSql('CREATE TABLE MovieActors (movieID INTEGER NOT NULL, actorID INTEGER NOT NULL, created_date DATETIME NOT NULL, updated_date DATETIME DEFAULT NULL, created_admin_userID INTEGER DEFAULT NULL, updated_admin_userID INTEGER DEFAULT NULL)');
        $this->addSql('CREATE TABLE MovieClassificationComponents (movieID INTEGER NOT NULL, classification_componentID INTEGER NOT NULL, created_date DATETIME NOT NULL, updated_date DATETIME DEFAULT NULL, updated_admin_userID INTEGER DEFAULT NULL, created_admin_userID INTEGER DEFAULT NULL)');
        $this->addSql('CREATE TABLE MovieCountries (movieID INTEGER NOT NULL, countryID INTEGER NOT NULL, created_date DATETIME NOT NULL, updated_date DATETIME DEFAULT NULL, created_admin_userID INTEGER DEFAULT NULL, updated_admin_userID INTEGER DEFAULT NULL)');
        $this->addSql('CREATE TABLE MovieDirectors (movieID INTEGER NOT NULL, directorID INTEGER NOT NULL, created_date DATETIME NOT NULL, updated_date DATETIME DEFAULT NULL, created_admin_userID INTEGER DEFAULT NULL, updated_admin_userID INTEGER DEFAULT NULL)');
        $this->addSql('CREATE TABLE MovieGenres (movieID INTEGER NOT NULL, genreID INTEGER NOT NULL, created_ID DATETIME NOT NULL, updated_date DATETIME DEFAULT NULL, created_admin_userID INTEGER DEFAULT NULL, updated_admin_userID INTEGER DEFAULT NULL)');
        $this->addSql('CREATE UNIQUE INDEX movie_genreID ON MovieGenres (movieID, genreID)');
        $this->addSql('CREATE TABLE MovieShowingSeats (movieshowID INTEGER DEFAULT NULL, seatID INTEGER DEFAULT NULL, seatstatus BOOLEAN DEFAULT NULL, booking_date DATETIME DEFAULT NULL, deleted_date DATETIME DEFAULT NULL)');
        $this->addSql('CREATE TABLE MovieShows (movie_showID INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, movieID INTEGER DEFAULT NULL, auditoriumID INTEGER DEFAULT NULL, play_times_and_dates DATETIME NOT NULL, created_date DATETIME NOT NULL, updated_date DATE DEFAULT NULL, created_admin_userID INTEGER DEFAULT NULL, updated_admin_userID INTEGER DEFAULT NULL)');
        $this->addSql('CREATE TABLE MovieSpokenLanguages (movieID INTEGER NOT NULL, languageID INTEGER NOT NULL, created_date DATETIME NOT NULL, updated_date DATETIME DEFAULT NULL, created_admin_user_ID INTEGER DEFAULT NULL, updated_admin_user_date INTEGER DEFAULT NULL)');
        $this->addSql('CREATE TABLE MovieUndertitleLanguages (movieID INTEGER NOT NULL, languageID INTEGER NOT NULL, created_date DATETIME DEFAULT NULL, updated_date DATETIME DEFAULT NULL, created_admin_userID INTEGER DEFAULT NULL, updated_admin_user INTEGER DEFAULT NULL)');
        $this->addSql('CREATE TABLE Movies (movieID INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, movie_title VARCHAR(100) DEFAULT NULL COLLATE BINARY, synopsis CLOB DEFAULT NULL COLLATE BINARY, movie_length INTEGER DEFAULT NULL, release_year INTEGER DEFAULT NULL, rating_ageID VARCHAR(2) NOT NULL COLLATE BINARY, additionalID INTEGER DEFAULT NULL, rental_days INTEGER DEFAULT NULL, trailer_link VARCHAR(64) DEFAULT NULL COLLATE BINARY, created_date DATETIME DEFAULT NULL, updated_date DATETIME DEFAULT NULL, created_admin_userID INTEGER DEFAULT NULL, updated_admin_userID INTEGER DEFAULT NULL)');
        $this->addSql('CREATE TABLE Noshows (noshowID INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, noshow_number INTEGER DEFAULT NULL, created_date DATETIME DEFAULT NULL, updated_date DATETIME DEFAULT NULL, created_admin_userID INTEGER DEFAULT NULL, updated_admin_userID INTEGER DEFAULT NULL)');
        $this->addSql('CREATE TABLE Prices (priceID INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, rate_description VARCHAR(30) DEFAULT NULL COLLATE BINARY, price NUMERIC(10, 0) DEFAULT NULL, currencyID INTEGER NOT NULL, valid BOOLEAN NOT NULL, valid_from_date DATE DEFAULT NULL, created_admin_userID INTEGER DEFAULT NULL)');
        $this->addSql('CREATE TABLE Roles (roleID INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, role_name VARCHAR(20) NOT NULL COLLATE BINARY, created_date DATETIME NOT NULL, updated_date DATETIME DEFAULT NULL, created_admin_userID INTEGER DEFAULT NULL, updated_admin_userID INTEGER DEFAULT NULL)');
        $this->addSql('CREATE TABLE Seats (seatID INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, auditoriumID INTEGER DEFAULT NULL, seat_row VARCHAR(2) DEFAULT NULL COLLATE BINARY, seat_number INTEGER DEFAULT NULL, created_date DATETIME DEFAULT NULL, updated_date DATETIME DEFAULT NULL, created_admin_userID INTEGER DEFAULT NULL, updated_admin_userID INTEGER DEFAULT NULL)');
        $this->addSql('CREATE TABLE States_Provinces_Departments (stateID INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, state_name VARCHAR(60) NOT NULL COLLATE BINARY, abbreviation VARCHAR(3) DEFAULT NULL COLLATE BINARY, countryID INTEGER NOT NULL, created_date DATETIME NOT NULL, updated_date DATETIME DEFAULT NULL, created_admin_userID INTEGER DEFAULT NULL, updated_admin_userID INTEGER DEFAULT NULL)');
        $this->addSql('CREATE TABLE TicketOrderlines (ticket_orderline_ID INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, ticketID INTEGER NOT NULL, seatID INTEGER NOT NULL, priceID INTEGER NOT NULL)');
        $this->addSql('CREATE TABLE Tickets (ticketID INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, userD INTEGER NOT NULL, movie_showID INTEGER NOT NULL, parking_price_ID INTEGER NOT NULL, booking_date DATETIME NOT NULL, annulated_date DATETIME DEFAULT NULL)');
        $this->addSql('CREATE TABLE Users (userID INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, UUID VARCHAR(32) DEFAULT NULL COLLATE BINARY, reset_token VARCHAR(16) DEFAULT NULL COLLATE BINARY, token_expire_time DATETIME DEFAULT NULL, user_firstname VARCHAR(60) DEFAULT NULL COLLATE BINARY, user_lastname VARCHAR(60) DEFAULT NULL COLLATE BINARY, user_adres VARCHAR(60) DEFAULT NULL COLLATE BINARY, cityID INTEGER DEFAULT NULL, email VARCHAR(255) NOT NULL COLLATE BINARY, password VARCHAR(255) NOT NULL COLLATE BINARY, phone VARCHAR(15) DEFAULT NULL COLLATE BINARY, genderID VARCHAR(1) DEFAULT NULL COLLATE BINARY, birthday DATE DEFAULT NULL, roleID INTEGER DEFAULT NULL, softdelete_state BOOLEAN DEFAULT NULL, no_showID INTEGER DEFAULT NULL, created_date DATETIME DEFAULT NULL, updated_date DATETIME DEFAULT NULL)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__genders AS SELECT id, gender_name, gender_abbreviation FROM genders');
        $this->addSql('DROP TABLE genders');
        $this->addSql('CREATE TABLE genders (gender_name VARCHAR(18) NOT NULL, gender_abbreviation VARCHAR(1) NOT NULL, genderID INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL)');
        $this->addSql('INSERT INTO genders (genderID, gender_name, gender_abbreviation) SELECT id, gender_name, gender_abbreviation FROM __temp__genders');
        $this->addSql('DROP TABLE __temp__genders');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74');
        $this->addSql('DROP INDEX IDX_8D93D649708A0E0');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, gender_id, email, roles, user_firstname, password, user_lastname, user_adress, phone, birthday FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL, gender_id INTEGER DEFAULT NULL, roles CLOB DEFAULT NULL COLLATE BINARY, user_firstname VARCHAR(60) DEFAULT NULL COLLATE BINARY, user_lastname VARCHAR(60) DEFAULT NULL COLLATE BINARY, user_adress VARCHAR(60) DEFAULT NULL COLLATE BINARY, phone VARCHAR(15) DEFAULT NULL COLLATE BINARY, birthday DATE DEFAULT NULL)');
        $this->addSql('INSERT INTO user (id, gender_id, email, roles, user_firstname, password, user_lastname, user_adress, phone, birthday) SELECT id, gender_id, email, roles, user_firstname, password, user_lastname, user_adress, phone, birthday FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }
}
