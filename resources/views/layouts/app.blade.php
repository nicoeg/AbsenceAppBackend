<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('styles')
</head>
<body>
    <div id="app">
        <v-app>
            <v-navigation-drawer app fixed disable-route-watcher v-model="drawer">
                <v-list dense>
                    <v-list-tile @click="navigateTo('/')">
                        <v-list-tile-action>
                            <v-icon>home</v-icon>
                        </v-list-tile-action>
                        <v-list-tile-content>
                            <v-list-tile-title>Klasser</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </v-list>
            </v-navigation-drawer>
            <v-toolbar app fixed color="primary" dark>
                <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
                <v-toolbar-title v-text="$route.meta.title"></v-toolbar-title>

                <div v-if="$route.meta.searchable" class="d-flex align-center" style="margin-left: auto; height: 30px">
                    <v-btn v-if="!searching" icon @click="toggleSearching">
                        <v-icon>search</v-icon>
                    </v-btn>

                    <v-text-field
                        v-else
                        v-model="search"
                        append-icon="search"
                        ref="searchInput"
                        @blur="toggleSearching"
                    ></v-text-field>
                </div>
            </v-toolbar>

            <v-content>
                @yield('content')
            </v-content>

            <v-footer app></v-footer>
        </v-app>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
