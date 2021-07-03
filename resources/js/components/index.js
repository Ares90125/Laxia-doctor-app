import Vue from 'vue'
import Card from './Card'
import Child from './Child'
import Button from './Button'
import Checkbox from './Checkbox'
import Pagination from './Pagination'
import FormModal from './FormModal'
import ResetConfirmModal from './ResetConfirmModal'
import QuestionMenuModal from './QuestionMenuModal'
import QuestionDeleteModal from './QuestionDeleteModal'
import FileUpload from './FileUpload'
import FileUploadSingle from './FileUploadSingle'
import FileUploadAnswer from './FileUploadAnswer'
import QuestionAddBox from './QuestionAddBox'
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
  QuestionDeleteModal,
  FileUpload,
  FileUploadSingle,
  FileUploadAnswer,
  QuestionAddBox,
].forEach(Component => {
  Vue.component(Component.name, Component)
})
