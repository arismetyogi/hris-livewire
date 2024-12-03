import {Livewire} from "../../vendor/livewire/livewire/dist/livewire.esm";
import "./bootstrap";

import "toastify-js/src/toastify.css";
import Toastify from "toastify-js";

Livewire.start();

window.Toastify = Toastify;
