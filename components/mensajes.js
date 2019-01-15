Vue.component('mensaje', {
    template: `
    <transition name="fade">
                    
        <div class="alert bg-green" v-if="$parent.successMensaje">
            <i class="material-icons">check_circle</i> {{ $parent.successMensaje }}
        </div>
        <div class="alert bg-red" v-if="$parent.errorMensaje">
            <i class="material-icons">error</i> {{ $parent.errorMensaje }}
        </div>

    </transition>
    `
  });