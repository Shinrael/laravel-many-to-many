<!-- Contenitore principale che utilizza Alpine.js per gestire lo stato di visibilità dell'aside -->
<div x-data="{
    {{-- // Inizializzazione dello stato isOpen con il valore salvato in local storage --}}
    isOpen: JSON.parse(localStorage.getItem('asideOpen')) || false
}"
{{-- // Al caricamento della pagina, osserva i cambiamenti di isOpen e aggiorna il local storage di conseguenza --}}
x-init="$watch('isOpen', value => localStorage.setItem('asideOpen', JSON.stringify(value)))"
class="relative">

<!-- Bottone per il toggle dell'aside. Al click, il valore di isOpen viene invertito (true/false) -->
<button @click="isOpen = !isOpen" id="toggle-aside" class="btn btn-primary custom-toggle-btn">
    <i class="fa-solid fa-bars"></i>
</button>

<!-- Aside: la visibilità è controllata dalla classe 'visible', che viene aggiunta o rimossa in base allo stato di isOpen -->
<aside class="bg-dark navbar-dark text-white flex-shrink-0"
       :class="{'visible': isOpen}"
       id="sidebar" >
    <nav>
        <ul>
            <li>
                <!-- Link di navigazione con icone e testo -->
                <a href="{{ route('admin.projects.index') }}">
                    <i class="fa-solid fa-diagram-project"></i>
                    <span>Elenco Progetti</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.projects.create') }}">
                    <i class="fa-solid fa-square-plus"></i>
                    <span>Nuovo progetto</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.technologies.index') }}">
                    <i class="fa-solid fa-microchip"></i>
                    <span>Elenco Tecnologie</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.types.index') }}">
                    <i class="fa-solid fa-clipboard-list"></i>
                    <span>Elenco Tipologie</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.type_projects') }}">
                    <i class="fa-solid fa-clipboard-list"></i>
                    <span>Elenco Progetti per Tipi</span>
                </a>
            </li>
        </ul>
    </nav>
</aside>
</div>
