# tmp_tasks
Wymagania:
1. XAMPP - https://www.apachefriends.org/pl/index.html

Jak skonfigurować projekt:
1. Po zainstalowaniu oprogramowania XAMPP folder projektu tj. "tmp_tasks-master" (można zmienić) należy przenieść do folderu xampp/htdocs,
2. Należy włączyć pakiet XAMPP oraz uruchomić serwisy Apache i MySQL,
3. W przeglądarce wpisać adres "localhost",
4. W prawym górnym rogu wybrać "phpMyAdmin",
5. W panelu po lewej stronie kliknąć "Nowa" w celu stworzenia bazy danych. Wprowadzić "tmp_task" jako nazwę oraz wybrać "utf8_polish_ci" w oknie obok,
6. Na górnym pasku wybrać opcję "Import" następnie wybrać plik "tmp_task.sql" z folderu "database" w projekcie i nacisnąć przycisk "Wykonaj".

Korzystanie z aplikacji:
1. Jeśli wszystko zostało skonfigurowane poprawnie aplikacja jest dostępna w przeglądarce pod adresem "localhost/tmp_tasks-master" (localhost/nazwa_folderu_projektu jeśli była zmieniona),
2. Wszystkie funkcjonalności działają bez ingerencji w bazę danych z poziomu pliku index.php
