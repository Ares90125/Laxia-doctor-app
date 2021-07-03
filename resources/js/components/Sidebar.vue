<template>
  <div class="sidebar">
    <div class="logo">
      <router-link :to="{ name: 'user_profile' }">
        <svg width="98" height="26" viewBox="0 0 98 26" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M0.168 0.512H3.192V23.192H14.856V26H0.168V0.512ZM26.448 0.512H29.292L40.128 26H36.6L34.008 19.736H21.264L18.636 26H15.216L26.448 0.512ZM27.816 4.4H27.744L22.452 16.928H32.856L27.816 4.4ZM49.5277 12.572L40.9597 0.512H44.8477L51.7237 10.484L58.5277 0.512H62.3077L53.7397 12.572L63.1357 26H59.1397L51.5797 14.696L43.9837 26H40.2397L49.5277 12.572ZM66.1914 0.512H69.2154V26H66.1914V0.512ZM83.823 0.512H86.667L97.503 26H93.975L91.383 19.736H78.639L76.011 26H72.591L83.823 0.512ZM85.191 4.4H85.119L79.827 16.928H90.231L85.191 4.4Z" fill="#728396"/>
        </svg>
      </router-link>
    </div>

    <div class="menu-avatar-container">
       <div class="menu-avatar-img-container">
         <img v-if="user.photo" :src="'/'+user.photo" class="rounded-circle avatar-photo">
         <img v-if="!user.photo" :src="'/img/avatar-img.png'" class="rounded-circle avatar-photo">
       </div>
      <div class="menu-avatar-name">
        <p>{{user.hira_name}}</p>
      </div>
    </div>

    <div class="menu">
      <ul class="sidebar-menu-list">
        <li>
          <router-link :to="{ name: 'user_profile' }" active-class="active">
            <p class="stroke">
              <svg width="18" height="21" viewBox="0 0 18 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M17 19.6665V17.6665C17 16.6056 16.5786 15.5882 15.8284 14.8381C15.0783 14.0879 14.0609 13.6665 13 13.6665H5C3.93913 13.6665 2.92172 14.0879 2.17157 14.8381C1.42143 15.5882 1 16.6056 1 17.6665V19.6665" stroke="#728396" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M9 9.6665C11.2091 9.6665 13 7.87564 13 5.6665C13 3.45736 11.2091 1.6665 9 1.6665C6.79086 1.6665 5 3.45736 5 5.6665C5 7.87564 6.79086 9.6665 9 9.6665Z" stroke="#728396" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </p>
            <span>{{ $t('プロフィール') }}</span>
          </router-link>
        </li>
        <li>
          <router-link :to="{ name: 'user_illcase' }" active-class="active">
            <p class="fill">
              <svg width="22" height="16" viewBox="0 0 22 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M18.1111 13.7143V14.2857C18.1111 15.2325 17.3152 16 16.3333 16H2.11109C1.12924 16 0.333313 15.2325 0.333313 14.2857V5.14286C0.333313 4.19607 1.12924 3.42857 2.11109 3.42857H2.70368V5.14286H2.33331C2.27438 5.14286 2.21785 5.16543 2.17618 5.20562C2.1345 5.24581 2.11109 5.30031 2.11109 5.35714V14.0714C2.11109 14.1283 2.1345 14.1828 2.17618 14.223C2.21785 14.2631 2.27438 14.2857 2.33331 14.2857H16.1111C16.17 14.2857 16.2266 14.2631 16.2682 14.223C16.3099 14.1828 16.3333 14.1283 16.3333 14.0714V13.7143H18.1111ZM19.6666 1.71429H5.88887C5.82993 1.71429 5.77341 1.73686 5.73173 1.77705C5.69006 1.81723 5.66665 1.87174 5.66665 1.92857V10.6429C5.66665 10.6997 5.69006 10.7542 5.73173 10.7944C5.77341 10.8346 5.82993 10.8571 5.88887 10.8571H19.6666C19.7256 10.8571 19.7821 10.8346 19.8238 10.7944C19.8655 10.7542 19.8889 10.6997 19.8889 10.6429V1.92857C19.8889 1.87174 19.8655 1.81723 19.8238 1.77705C19.7821 1.73686 19.7256 1.71429 19.6666 1.71429ZM19.8889 0C20.8707 0 21.6666 0.7675 21.6666 1.71429V10.8571C21.6666 11.8039 20.8707 12.5714 19.8889 12.5714H5.66665C4.68479 12.5714 3.88887 11.8039 3.88887 10.8571V1.71429C3.88887 0.7675 4.68479 0 5.66665 0H19.8889ZM10.1111 4C10.1111 4.78896 9.44779 5.42857 8.62961 5.42857C7.81142 5.42857 7.14813 4.78896 7.14813 4C7.14813 3.21104 7.81142 2.57143 8.62961 2.57143C9.44779 2.57143 10.1111 3.21104 10.1111 4ZM7.44442 7.42857L8.90794 6.01732C9.0815 5.84996 9.3629 5.84996 9.5365 6.01732L11 7.42857L14.8339 3.73161C15.0074 3.56425 15.2888 3.56425 15.4624 3.73161L18.1111 6.28571V9.14286H7.44442V7.42857Z" fill="#728396"/>
              </svg>
            </p>
            <span>{{ $t('症例') }}</span>
          </router-link>
        </li>
        <li>
          <router-link :to="{ name: 'user_question' }" active-class="active">
            <p class="fill">
              <svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M19 0.666504H2.99998C1.52915 0.666504 0.333313 1.71286 0.333313 2.99984V13.4998C0.333313 14.7868 1.52915 15.8332 2.99998 15.8332H6.99998V18.8957C6.99998 19.1545 7.24165 19.3332 7.49998 19.3332C7.59998 19.3332 7.70415 19.3077 7.79581 19.2457L13 15.8332H19C20.4708 15.8332 21.6666 14.7868 21.6666 13.4998V2.99984C21.6666 1.71286 20.4708 0.666504 19 0.666504ZM19.6666 13.4998C19.6666 13.8207 19.3666 14.0832 19 14.0832H12.3333L11.8 14.4332L8.99998 16.2707V14.0832H2.99998C2.63331 14.0832 2.33331 13.8207 2.33331 13.4998V2.99984C2.33331 2.679 2.63331 2.4165 2.99998 2.4165H19C19.3666 2.4165 19.6666 2.679 19.6666 2.99984V13.4998Z" fill="#728396"/>
              </svg>
            </p>
            <span>{{ $t('質問') }}</span>
          </router-link>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import LocaleDropdown from './LocaleDropdown'

export default {
  components: {
    LocaleDropdown
  },

  data: () => ({
    appName: window.config.appName
  }),

  computed: mapGetters({
    user: 'auth/user'
  }),

  methods: {
  }
}
</script>

<style scoped>
/* .profile-photo {
  width: 2rem;
  height: 2rem;
  margin: -.375rem 0;
}

.menu-avatar-img-container{
  display: flex;
  justify-content: center;
  margin-bottom: 15px;
}
.avatar-photo{
  width: 90px;
}

.menu-avatar-name{
  display: flex;
  justify-content: center;
  font-size: 20px;
  font-weight: 600;
  margin-bottom: 30px;
} */
</style>
