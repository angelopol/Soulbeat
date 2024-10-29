@extends('layouts.base')

@section('title') Settings @php $css = "settings" @endphp @endsection

@section('content')
    @include('components.NavBar.aside')
    
    <div class="wrapper">
        @include('components.NavBar.settings')
        <div class="wrapper-user" id="user">

            <div class="contenedores">
                <span class="app-parameters">Global parameters</span>
                <nav class="medio drop">
                    <div class="dropdown">
                        <span class="lenguage">Lenguage</span>
                        <ul class="dropdown-content">
                            <li id="es">Spanish</li>
                            <li id="en">English</li>
                        </ul>
                    </div>
                    <span class="result"> result</span>
                </nav>
                <nav class="fro">
                    <div class="currency-selector">
                        <label class="label" for="currency-select">Change Currency</label>
                        <select id="currency-select">
                            <option value="usd" class="option">USD</option>
                            <option value="bs" class="option">BS</option>
                        </select>
                    </div>
                </nav>
            </div>

            <div class="contenedores">
                <div class="content-user">
                    <span class="u">User</span>
                    <div class="user-settings">
                        <span  class="item" style="color:white; font: inherit;">Change whatever you want</span>
                        <input class="item" type="text" id="username" placeholder="Usuario Anterior" />
                        <input class="item" type="email" id="email" placeholder="Email Anterior" />
                        <div class="con item">
                            <input type="password" id="password" placeholder="Contraseña" />
                            <button class="ie" id="toggle-password"><i class="bi bi-eye"></i></button>
                        </div>
                    </div>
                    <div id="modal1" class="modal">
                        <div class="modal-content">
                            <span class="cierra">&times;</span>
                            <p>Introduce tu contraseña actual para continuar</p>
                            <div class="sepa">
                                <input type="password" id="current-password1" placeholder="Contraseña actual" />
                                <button id="confirm-password1">Confirmar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="contenedor-subs">
                <nav>
                    <span class="suscri">Suscripciones</span>
                </nav>
                <nav>
                    <div class="card">
                        <span ><i class="bi bi-patch-check-fill mora"></i></span>
                        <ul class="caracteristic-card">
                            <li class="pichi">Mayor visibilidad </li>
                            <li class="pichi">confianza y seguridad para compradores</li>
                            <li class="pichi">y acceso prioritario a nuevas herramientas.</li>
                        </ul>
                        <button class="boton-card">Subscribirte</button>
                    </div>
                </nav>
            </div>

            <div class="contenedores-ads">
                <nav>
                    <span class="ads">Ads</span>
                </nav>
                <div class="anuncio"> <!--componente de anuncio-->
                    <nav>
                        <div class="post">
                            <img class="foto" src="../front/images/foto-tupac-landing.jpeg" alt="">
                            <span class="nombredelbeat">nombre del post-beat</span>
                        </div>
                    </nav>
                    <nav>
                        <span class="price">9.00$</span>
                    </nav>
                    <nav>
                        <span class="time">19/10/24<span>
                    </nav>
                </div>
            </div>

            <div class="contenedores">
                <span class="support">Support</span>
                <nav class="primerparte-support">
                
                    <button class="contact">Contact to agent</button>
                </nav>
                <nav>
                    <button class="qa">Q & A</button>
                </nav>
                <nav>
                    <button class="guides"> Guides</button>
                </nav>
            </div>
            
            <div class="danger contenedores">
                <span class="zone">Danger Zone</span>
                <button class="closer"> Close account</button>
                <div id="modal2" class="modal modale">
                    <div class="modal-content">
                        <span class="cierra">&times;</span>
                        <p style="color: white;">¿estás seguro que quieres cerrar esta cuenta?</p>
                        <div class="sepa">
                            <button id="confirm-password2">Confirmar</button>
                            <button id="cancel-button2">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ Vite::asset('resources/js/settings.js') }}"></script>
@endsection