function page (path) {
  return () => import(/* webpackChunkName: '' */ `~/pages/${path}`).then(m => m.default || m)
}

export default [
  { path: '/', name: 'welcome', component: page('welcome.vue') },

  { path: '/login', name: 'login', component: page('auth/login.vue') },
  { path: '/register', name: 'user_register', component: page('auth/register.vue') },
  { path: '/forgetpassword', name: 'forgetpassword', component: page('auth/forgetpassword.vue') },
  { path: '/reset', name: 'reset', component: page('auth/reset.vue') },
  { path: '/profile', name: 'user_profile', component: page('profile/index.vue') },
  { path: '/illcase', name: 'user_illcase', component: page('illcase/index.vue') },
  { path: '/question', name: 'user_question', component: page('question/index.vue') },
  { path: '/questiondetail/:id', name: 'user_questiondetail', component: page('questiondetail/index.vue') },
  { path: '/resetpassword', name: 'resetpassword', component: page('resetpassword/index.vue') },

  { path: '/privacy', name: 'privacy', component: page('privacy/index.vue') },
  { path: '/tos', name: 'tos', component: page('tos/index.vue') },
  { path: '/guidelines', name: 'guidelines', component: page('guidelines/index.vue') },
  { path: '/contact', name: 'contact', component: page('contact/index.vue') },
  { path: '/contact/thanks', name: 'contact_thanks', component: page('contact/thanks/index.vue') },
  // { path: '/home', name: 'home', component: page('home.vue') },
  // { path: '/settings',
  //   component: page('settings/index.vue'),
  //   children: [
  //     { path: '', redirect: { name: 'settings.profile' } },
  //     { path: 'profile', name: 'settings.profile', component: page('settings/profile.vue') },
  //     { path: 'password', name: 'settings.password', component: page('settings/password.vue') }
  //   ]
  // },

  { path: '*', component: page('errors/404.vue') },

  // テスト用
  { path: '/test/mailboxes/:id', name: 'test-mailbox', component: page('mailbox/test.vue') },
]
