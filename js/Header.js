new Vue({
    el: '#header',
    data: {
      sidebarActive: false
    },
    methods: {
      toggleSidebar() {
        this.sidebarActive = !this.sidebarActive;
      }
    }
});