## Wymagania co do projektu:  

Back-end: PHP7+, bez używania dodatkowych frameworków z wykorzystaniem zasady MVC.
Front-end: Mile widziane użycie jQuery.
Baza: mysql lub mariadb


Funkcjonalności:
 
1. Zarządzanie użytkownikami:
 
a. Lista użytkowników  
b. Dodawanie użytkownika  
c. Usuwanie użytkownika  
d. Edycja użytkownika  
 
2. Zarządzanie grupami użytkowników:
 
a. Lista grup użytkowników  
b. Dodawanie grupy użytkowników  
c. Usuwanie grupy użytkowników  
d. Edycja grupy użytkowników  


Struktura danych
 
1. Użytkownik:

a. Nazwa  
b. Hasło  
c. Imię  
d. Nazwisko  
e. Data urodzenia  
f. Lista wszystkich grup, do których należy użytkownik  

2. Grupa użytkowników:

a. Nazwa  
b. Lista użytkowników, którzy należą do grupy
 
Aplikacja powinna umożliwiać edycję wszystkich powyższych własności, także list.  

## Opis rozwiązania

Głowne pliki to wykaz użytkowników `show_users.php` i wykaz grup `show_groups.php`.
Z nich wywołuje się wszystkie akcje.
Modele są w folderze `models`, a widoki to `users_view.php` i `groups_view.php`

Można dodawać i usuwać użytkowników, grupy, a także  
dodawać i usuwać użytkowników do/z grupy oraz  
dodawać i usuwać grupy dla danego użytkownika.  

Grupy nie można usunąć, gdy ma ona użytkowników. Przycisk `Delete group` jest wtedy nieaktywny.

Natomiast można usunąć użytkownika, mimo iż jest w jakichś grupach - wtedy zostanie on usunięty z nich, dzięki *kaskadom* w bazie:

```sql
ALTER TABLE `user_groups` ADD  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;
```

`jQuery` jest używane tylko do usuwania atrybutu `required` przy naciśnięciu przycisku `Delete` i `Cancel`
oraz do zmiany sposobu wyświetlania listy grup i chowania kolumny z hasłami.

## Do zrobienia

W następnej wersji chcę wykorzystać Bootstrap i dialogi modalne do edycji i usuwania grup i użytkowników. 
Warto też zmienić funkcje do obsługi bazy danych, (użyć sparametryzownych prepared statements ) 
by zapewnić ochronę przed SQL injection.
