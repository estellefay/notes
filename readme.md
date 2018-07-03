# Notes révisions certification


## Auth
#### php artisan make:auth
- header : voir header
- layout : voir app
- register : voir register
- login : voir login
- email : voir email
- reset : voir reset


## NavigationController
#### php artisan make:controller <Nom>Comtroller
- une fonction "showPage(Request $request)"
- si le $request->path() est différent de "/"
- alors tente de retourner ce $request->path()
- si catch (\Exception $e) alors retourne une abort('erreur 404')
- sinon, retourne la vue 'home'
- route : '/{all?}'


## template.blade.php
- titre : {{ config('app.name') }} : @yield('title')
- css : href="{{ URL::asset('/css/base.less') }}"
- dans le body :
    - header : @include('parts/header')
    - main :
       - aside :  @include('parts/aside')
       - section :
          - @yield('content')
          - footer


## <nom>.blade.php
- @extends('layouts.app')
- @section('content')
- contenu
- @endsection


## CRUD
#### read
- getAll
   - créer $users récuperant tous les users
   - retourner la vue avec 'nom du blade', ['users' => $users]
- vue
   - @foreach ($users as $user)
   - {{ $user->name }}
- getOne
   - find le User par id (penser à ->load('lessons'))
   - retourner la variable si utilisation de JS
      - document.querySelector('body').addEventListener('click', function(el) {});
      - requête ajax
      - Ajouter le contenu dans la requête ajax
         - const user = JSON.parse(this.response);
         - const lessons = user.lessons;
         - const modalContainer = document.querySelector('.modal-container');
         - const modal = document.querySelector('.modal');
         - Vider le contenu de .modal-container
         - remplir les éléments créés avec les données
         - appendchild à la modalContainer
         - penser à remote la classe 'hidden'
   - public function getOne(Request $request, $id)
    {
        $user = User::find($id)->load('lessons');
        return $user;
    }

#### create
- insertForm
   - créer $genres récupérant tous les genres
   - retourner la vue du formulaire d'insertion
- insertAction
   - créer $form récupérant la request->input
   - unset($form['_token']); si besoin
   - instancier un new User
   - faire correspondre les inputs avec les colonnes
   - sauvegarder l'instance
   - return redirect('/users');
   - si checkbox ;
      - $lessons = $request->input('lessons');
      - foreach ($lessons as $lesson) {
            $newUser->lessons()->attach($lesson);

        }
       - Penser à save avant pour avoir un user_id

#### delete
- deleteAction
   - récupérer l'id et détruire (User::destroy)
   - rediriger sur le getAll

#### update
- updateForm
   - créer $genres récupérant tous les genres
   - trouver le user (User::find) correspondant à l'id
   - retourner la vue avec les variables $user et $genres dans un tableau
- updateAction
   - idem que create sauf
      - ajouter après l'étape 2 de trouver l'id du user
      - si checkbox
         - détacher les genres
         - parcourir les genres et attacher le genre
- vue
   - penser à ajouter <input type="hidden" name="id">


## BDD
#### php artisan make:migration create_<noms>_table
- remplir les tables
#### php artisan migrate (migrate:fresh écrase les tables de même nom)
#### php artisan make:model <Nom>


## Seeders
#### php artisan make:seeder <Nom>TableSeeder
#### php artisan db:seed --class=<NomTableSeeder>
- DB::table('<nomsdelatable>')->insert([],[]);
- donner l'accès aux seeders ajoutés :
   - cp /var/www/html/composer.phar /var/www/html/project/composer.phar
   - php composer.phar dump-autoload
- table intermiédiare ex :
    [
        'student_id' => 1,
        'lesson_id'  => 2
    ],
- pour ajouter un created_at
   - Carbon::new('Y-m-d H:i:s');


## Tables intermédiaires
#### php artisan make:migration create_<nom1>_<nom2>_table
- mettre les <nom>_id des talbes correspondantes
- dans les Models des tables :
   - class <nom1>
    protected $hidden = ['password'];
    protected $guarded = ['password'];
    public function <nom2>()
    {
        return $this->belongsToMany('App\<nom2>');
    }
   - class <nom2>
    public function <noms1>()
        {
            return $this->belongsToMany('App\<nom1>');
        }
- si "oneToMany" : pas de tables intermédiaires, ajouter $table->integer('author_id'); à la table books


## Middleware
#### php artisan make:middleware Nom
- ajouter dans 'app/Http/middleswares/kernel.php' le middleware


## Requêtes AJAX
- structure get : voir exemple


## Models with tables
- Role
   - public function users()
        {
            return $this->belongsToMany('App\User');
        }

- User
   - public function roles()
    {
        return $this->belongsToMany('App\Role');
    }


## Validators
- Request
    - $rules = array(
            'password'  => 'required',
            'password2' => 'required|same:password'
        );
    - $validator = Validator::make(Input::all(), $rules);
    - if($validator->fails()) {
            $messages = $validator->messages();
            return Redirect::to('student.createOne')->withErrors($validator);
    }
- View
   - @if($errors->any())
   - <h4>{{ $errors->first() }}</h4>
   - @endif


## less
- http://lesscss.org/
- https://laravel.com/docs/5.6/mix#less
- dans webpack.mix.js
   - mix.less('resources/assets/less/app.less', 'public/css');
- installer npm sur la vagrant
   - curl -sL https://deb.nodesource.com/setup_8.x | sudo -E bash -
   - sudo apt-get install -y nodejs
   - npm install
- npm run watch-poll

- body {
-     font-family: 'Raleway', sans-serif;
-     color: #333;
-     margin: 0;
-     padding: 0;
-     header {
-         display: flex;
-         justify-content: center;
-         align-items: center;
-         width: 100%;
-         height: 10%;
-         background-color: lightcoral;
-     }
-     main {
-         display: flex;
-         flex-direction: row;
-         width: 100%;
-         aside {
-             display: flex;
-             flex-direction: column;
-             align-items: center;
-             width: 25%;
-             background-color: lightblue;
-         }
-         section {
-             display: flex;
-             flex-direction: column;
-             justify-content: space-between;
-             align-items: center;
-             width: 75%;
-             background-color: lightgoldenrodyellow;
-             footer {
-                 display: flex;
-                 justify-content: center;
-                 align-items: center;
-                 width: 100%;
-                 height: 60px;
-                 background-color: lightgreen;
-             }
-         }
-     }
-     h1, h2, h3, h4, h5, h6 {
-         padding: 0;
-         margin: 0;
-     }
- }


## HTML/CSS/MediaQueries
#### HTML
- header : menu, logo, titre du site, nav...
- main : contenu
   - section : partie sémantique d'une page
   - article : contenu ayant du sens sans le reste du contenu
   - aside : contient un contenu qui n'est pas principal dans la page (une barre latérale)
- footer : menu, copyright, infos légales, contact...
- https://developer.mozilla.org/fr/docs/Web/HTML/Element

#### CSS/MediaQueries
