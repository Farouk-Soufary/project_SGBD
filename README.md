# project_SGBD
Ceci est le code source du projet SGBD en 2ème année d'informatique, ENSEIRB-MATMECA, Bordeaux.

Suivez ces instructions afin de faire fonctionner correctement le site web, et ainsi consulter et modifier notre base de données.

* Notre site Web est basé sur [PHP](https://www.php.net/), [JS](https://developer.mozilla.org/fr/docs/Web/JavaScript) et [SQL](https://www.mysql.com/fr/). Pour le faire fonctionner, vous aurez besoin d'un hôte local (localhost).

* vous pouvez soit utiliser [WAMP](https://www.wampserver.com/) (Windows) ou [XAMPP](https://www.apachefriends.org/fr/index.html) (Linux et MacOS). Ou visitez notre site web en ligne [ici](http://jeuxproject.atwebpages.com).

* * vous utilisez **WAMP**, le site web devrait fonctionner correctement, et vous devriez juste copier ce repo dans le répertoire ```Wamp64/www/``` et accéder au _index.php_ manuellement dans votre navigateur.

* * Dans le cas où vous utilisez **XAMPP**, ```LaunchDB.php``` pourrait ne pas fonctionner correctement, nous vous suggérons fortement d'importer manuellement _create.sql_ et _insert.sql_ dans votre localhost.
Cliquez ici pour savoir comment accéder à votre [PhpMyAdmin](http://localhost/phpmyadmin4.9.7/index.php). (login: 'root', pw: '', server: MySQL).


Après avoir accéder à PhpMyAdmin, choisissez la base de données ```mysql``` et importez puis executez ces deux fichiers.

* Dans ce répertoire, vous trouverez trois répertoires différents, le répertoire ```src/``` est spécifique pour le code de l'interface (site web), les source code et les ressources. 

* Le répertoire ```sql/``` contient tout le code sql que nous utilisons pour manipuler, consulter et analyser correctement notre base de données. Vous pouvez exécuter ce code sur _Oracle_, _Mysql_ (notre cas) ou _MariaDB_. 

* Le répertoire ```gamegen/``` contient des scripts _Python_ qui nous ont aidés à créer nos fichiers _insert.sql_ et à mettre des commentaires, des noms, des jeux et autres aléatoires dans un lien spécifique et à les ajouter dans leur propre table.


Si vous rencontrez des problèmes lors de l'exécution de notre application web.
Veuillez nous contacter sur :
* [github](https://github.com/daJster/project_SGBD) , 
* e-mail : jelkarchi@enseirb-matmeca.fr 

Merci de votre compréhension.