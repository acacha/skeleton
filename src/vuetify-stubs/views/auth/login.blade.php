<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app" v-cloak>
    <v-app light>
        <v-layout column>
            <v-flex xs12 class="text-xs-center" mt-5>
                <h3>Login</h3>
            </v-flex>
            <v-flex xs12 sm6 offset-sm3 mt-3>
                <form>
                    <v-layout column>
                        <v-flex>
                            <v-text-field
                                    name="email"
                                    label="Email"
                                    id="email"
                                    type="email"
                                    required></v-text-field>
                        </v-flex>
                        <v-flex>
                            <v-text-field
                                    name="password"
                                    label="Password"
                                    id="password"
                                    type="password"
                                    required></v-text-field>
                        </v-flex>
                        <v-flex>
                            <v-text-field
                                    name="confirmPassword"
                                    label="Confirm Password"
                                    id="confirmPassword"
                                    type="password"
                            ></v-text-field>
                        </v-flex>
                        <v-flex class="text-xs-center" mt-5>
                            <v-btn primary type="submit">Sign Up</v-btn>
                        </v-flex>
                    </v-layout>
                </form>
            </v-flex>
        </v-layout>
    </v-app>
</div>
<script src="{{ asset('js/app.js') }}"></script>
<script>
  new Vue({
    el: '#app',
    data () {
      return {
        example: 'Laravel'
      }
    }
  })
</script>
</body>
</html>
