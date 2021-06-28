import Vue from 'vue'
import Card from './Card'
import Child from './Child'
import Button from './Button'
import Checkbox from './Checkbox'
import Pagination from './Pagination'
import FormModal from './FormModal'
import ResetConfirmModal from './ResetConfirmModal'
import QuestionMenuModal from './QuestionMenuModal'
import FileUpload from './FileUpload'
import { HasError, AlertError, AlertSuccess } from 'vform'

// Components that are registered globaly.
[
  Card,
  Child,
  Button,
  Checkbox,
  HasError,
  AlertError,
  AlertSuccess,
  Pagination,
  FormModal,
  ResetConfirmModal,
  QuestionMenuModal,
  FileUpload,
].forEach(Component => {
  Vue.component(Component.name, Component)
})
