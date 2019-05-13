CREATE DATABASE music;

USE music;

CREATE TABLE IF NOT EXISTS song(
    id INT AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    artist VARCHAR(255) ,
    album VARCHAR(255) ,
    gener VARCHAR(255) ,
    composer VARCHAR(255) ,
    youtubeLink VARCHAR(255) ,
    PRIMARY KEY (id)
);

INSERT INTO song (name, artist, album, gener, composer, youtubeLink) VALUES('Who Says','John Mayer','Battle Studies','Blues','John Mayer','akvu1AOnUIw');
INSERT INTO song (name, artist, album, gener, composer, youtubeLink) VALUES('Gravity','John Mayer','Battle Studies','Blues','John Mayer','7VBex8zbDRs');
INSERT INTO song (name, artist, album, gener, composer, youtubeLink) VALUES('Society','Eddie Vedder','Into the wild','Rock','Eddie Vedder','cl4cLEToPfc');
INSERT INTO song (name, artist, album, gener, composer, youtubeLink) VALUES('Guaranteed','Eddie Vedder','Into the wild','Rock','Eddie Vedder','Mwx3RvDWvDM');
INSERT INTO song (name, artist, album, gener, composer, youtubeLink) VALUES('Rise','Eddie Vedder','Eddie Vedder','Rock','Into the wild','jWbiCr200N8');
INSERT INTO song (name, artist, album, gener, composer, youtubeLink) VALUES('Mad World ','Gary Jules','Gary Jules','Pop','Another World','4N3N1MlvVc4');
INSERT INTO song (name, artist, album, gener, composer, youtubeLink) VALUES('Another Love ','Tom Odell','Pop','Tom Odell','Black Holes','MwpMEbgC7DA');
INSERT INTO song (name, artist, album, gener, composer, youtubeLink) VALUES('Habits (Stay High) ','Tove Lo','Pop','Tove Lo','Sheilds','SYM-RJwSGQ8');