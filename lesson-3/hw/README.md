# Translator

> Класс "Переводчик", который умеет переводить книги, журналы,  аудиокниги и фильмы. У каждого материала есть язык, на котором они написаны.
 
> На вход подается перечень языков, которые знает переводчик, и на выходе - список объектов, которые переводчик смог перевести.


## Usage

You can run the script in the following way:

    $ php index.php <arguments>

For example:

    $ php index.php uk en de
    $ php index.php "uk" "de" "fr"


This will return:

    Not translated          | fr | Book
    Successfully translated | en | Magazine
    Successfully translated | en | Audiobook
    Not translated          | de | Movie