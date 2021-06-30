<template>
  <div>
  </div>
</template>

<script>
export default {
  props: [],

  data() {
      return {
          user: undefined,
          snapShot: undefined
      }
  },

  mounted() {
      if (!this.user.firebase_key || this.user.firebase_key === '') this.registerFirebase();

      // this.registerSnapshot();
  },

  beforeDestroy() {
      if (this.snapShot) {
          this.snapShot();
      }
  },
  
  methods: {
      registerFirebase() {
        let self = this;
        firestore.collection('users').add({
          user_id: this.user.id,
          name: this.user.name,
          message_unread: 0,
          system_message: ''
        }).then(function (docRef) {
          axios.post('/cast/profile/update/firebase', {
            firebase_key: docRef.id,
            _token: self.csrf
          })
          this.user.firebase_key = docRef.id;
          this.registerSnapshot();
        })
      },

      updateFirebase(key, data) {
        firestore.collection('users').doc(key)
        .update(data)
      },
  },
}
</script>