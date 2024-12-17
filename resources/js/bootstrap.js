import {collapse} from '@alpinejs/collapse';
import {Alpine, Livewire} from "../../vendor/livewire/livewire/dist/livewire.esm";
import axios from 'axios';

Livewire.start();

Alpine.plugin(collapse);

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
