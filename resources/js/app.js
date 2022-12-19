import './bootstrap';
import './alpine';

import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';

window.Alpine = Alpine;

Alpine.plugin(collapse)

Alpine.start();


window.addEventListener('should:scroll', () => {
    window.scroll({
        top: 0,
        left: 0,
        behavior: "smooth"
    })
})
