import './bootstrap';
import './alpine';
import './alerts';

import Swal from 'sweetalert2'
import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';

window.Alpine = Alpine;

Alpine.plugin(collapse)

Alpine.start();

window.Swal = Swal;

window.addEventListener('should:scroll', () => {
    window.scroll({
        top: 0,
        left: 0,
        behavior: "smooth"
    })
})
