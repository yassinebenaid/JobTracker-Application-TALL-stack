<div x-data="scroller" x-show="shown" x-cloak x-on:click="$dispatch('should:scroll')"
    class="fixed bottom-20 right-20 bg-slate-200 px-5 py-4 cursor-pointer text-xl rounded-[50%] ">
    <i class="bi bi-chevron-up"></i>
</div>
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('scroller', () => ({
            shown: 0,

            init() {
                window.onscroll = () => {
                    if (window.scrollY > 200) this.shown = 1
                    else this.shown = 0
                }
            }
        }))
    })
</script>
