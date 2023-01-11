document.addEventListener("alpine:init", () => {
    Alpine.data('dropAndDrag', () => ({
        skills: [],

        get hasSkills() {
            return this.skills.length > 0
        },

        addSkill(name, id) {
            this.skills = this.skills.filter(e => e.id !== id)
            this.skills.push({
                "id": id,
                "name": name
            })
        },
        removeSkill(id) {
            this.skills = this.skills.filter(e => e.id !== id)
        },
        hasSkill(id) {
            return this.skills.filter(e => e.id === id)?.length > 0
        }

    }))
})

document.addEventListener("alpine:init", () => {
    Alpine.data('dropdown', () => ({
        open: false,

        toggle() {
            this.open = !this.open
        },

        hide(el = null) {
            this.open = false
        },
    }))
})
