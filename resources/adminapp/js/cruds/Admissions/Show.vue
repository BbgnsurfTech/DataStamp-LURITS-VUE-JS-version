<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary card-header-icon">
            <div class="card-icon">
              <i class="material-icons">remove_red_eye</i>
            </div>
            <h4 class="card-title">
              {{ $t('global.view') }}
              <strong>{{ $t('cruds.admission.title_singular') }}</strong>
            </h4>
          </div>
          <div class="card-body">
            <back-button></back-button>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="table-responsive">
                  <div class="table">
                    <tbody>
                      <tr>
                        <td class="text-primary">
                          {{ $t('cruds.admission.fields.id') }}
                        </td>
                        <td>
                          {{ entry.id }}
                        </td>
                      </tr>
                      <tr>
                        <td class="text-primary">
                          {{ $t('cruds.admission.fields.first_name') }}
                        </td>
                        <td>
                          {{ entry.first_name }}
                        </td>
                      </tr>
                      <tr>
                        <td class="text-primary">
                          {{ $t('cruds.admission.fields.middle_name') }}
                        </td>
                        <td>
                          {{ entry.middle_name }}
                        </td>
                      </tr>
                      <tr>
                        <td class="text-primary">
                          {{ $t('cruds.admission.fields.last_name') }}
                        </td>
                        <td>
                          {{ entry.last_name }}
                        </td>
                      </tr>
                      <tr>
                        <td class="text-primary">
                          {{ $t('cruds.admission.fields.code_ds_gender') }}
                        </td>
                        <td>
                          <datatable-enum :row="entry" field="code_ds_gender">
                          </datatable-enum>
                        </td>
                      </tr>
                      <tr>
                        <td class="text-primary">
                          {{ $t('cruds.admission.fields.dob') }}
                        </td>
                        <td>
                          {{ entry.dob }}
                        </td>
                      </tr>
                      <tr>
                        <td class="text-primary">
                          {{ $t('cruds.admission.fields.married') }}
                        </td>
                        <td>
                          <datatable-enum :row="entry" field="married">
                          </datatable-enum>
                        </td>
                      </tr>
                      <tr>
                        <td class="text-primary">
                          {{ $t('cruds.admission.fields.height') }}
                        </td>
                        <td>
                          {{ entry.height }}
                        </td>
                      </tr>
                      <tr>
                        <td class="text-primary">
                          {{ $t('cruds.admission.fields.minimum_income') }}
                        </td>
                        <td>
                          {{ entry.minimum_income }}
                        </td>
                      </tr>
                      <tr>
                        <td class="text-primary">
                          {{ $t('cruds.admission.fields.date_time') }}
                        </td>
                        <td>
                          {{ entry.date_time }}
                        </td>
                      </tr>
                      <tr>
                        <td class="text-primary">
                          {{ $t('cruds.admission.fields.email') }}
                        </td>
                        <td>
                          {{ entry.email }}
                        </td>
                      </tr>
                      <tr>
                        <td class="text-primary">
                          {{ $t('cruds.admission.fields.password') }}
                        </td>
                        <td>
                          {{ entry.password }}
                        </td>
                      </tr>
                      <tr>
                        <td class="text-primary">
                          {{ $t('cruds.admission.fields.size') }}
                        </td>
                        <td>
                          {{ entry.size }}
                        </td>
                      </tr>
                      <tr>
                        <td class="text-primary">
                          {{ $t('cruds.admission.fields.time') }}
                        </td>
                        <td>
                          {{ entry.time }}
                        </td>
                      </tr>
                      <tr>
                        <td class="text-primary">
                          {{ $t('cruds.admission.fields.multiple_file') }}
                        </td>
                        <td>
                          <datatable-attachments
                            :row="entry"
                            :field="'multiple_file'"
                          >
                          </datatable-attachments>
                        </td>
                      </tr>
                      <tr>
                        <td class="text-primary">
                          {{ $t('cruds.admission.fields.single_file') }}
                        </td>
                        <td>
                          <datatable-attachments
                            :row="entry"
                            :field="'single_file'"
                          >
                          </datatable-attachments>
                        </td>
                      </tr>
                      <tr>
                        <td class="text-primary">
                          {{ $t('cruds.admission.fields.multiple_photo') }}
                        </td>
                        <td>
                          <datatable-pictures
                            :row="entry"
                            :field="'multiple_photo'"
                          >
                          </datatable-pictures>
                        </td>
                      </tr>
                      <tr>
                        <td class="text-primary">
                          {{ $t('cruds.admission.fields.single_photo') }}
                        </td>
                        <td>
                          <datatable-pictures
                            :row="entry"
                            :field="'single_photo'"
                          >
                          </datatable-pictures>
                        </td>
                      </tr>
                      <tr>
                        <td class="text-primary">
                          {{ $t('cruds.admission.fields.belongs_to') }}
                        </td>
                        <td>
                          <datatable-single
                            :row="entry"
                            field="belongs_to.name"
                          >
                          </datatable-single>
                        </td>
                      </tr>
                      <tr>
                        <td class="text-primary">
                          {{ $t('cruds.admission.fields.belongs_to_many') }}
                        </td>
                        <td>
                          <datatable-list
                            :row="entry"
                            field="belongs_to_many.name"
                          >
                          </datatable-list>
                        </td>
                      </tr>
                      <tr>
                        <td class="text-primary">
                          {{ $t('cruds.admission.fields.text_area') }}
                        </td>
                        <td>
                          <ckeditor
                            :editor="editor"
                            :value="entry.text_area"
                            disabled
                          >
                          </ckeditor>
                        </td>
                      </tr>
                      <tr>
                        <td class="text-primary">
                          {{ $t('cruds.admission.fields.checkbox') }}
                        </td>
                        <td>
                          <datatable-checkbox :value="entry.checkbox">
                          </datatable-checkbox>
                        </td>
                      </tr>
                    </tbody>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import DatatableEnum from '@components/Datatables/DatatableEnum'
import DatatableAttachments from '@components/Datatables/DatatableAttachments'
import DatatablePictures from '@components/Datatables/DatatablePictures'
import DatatableSingle from '@components/Datatables/DatatableSingle'
import DatatableList from '@components/Datatables/DatatableList'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic'
import DatatableCheckbox from '@components/Datatables/DatatableCheckbox'

export default {
  components: {
    DatatableEnum,
    DatatableAttachments,
    DatatablePictures,
    DatatableSingle,
    DatatableList,
    ClassicEditor,
    DatatableCheckbox
  },
  data() {
    return {
      editor: ClassicEditor
    }
  },
  beforeDestroy() {
    this.resetState()
  },
  computed: {
    ...mapGetters('AdmissionsSingle', ['entry'])
  },
  watch: {
    '$route.params.id': {
      immediate: true,
      handler() {
        this.resetState()
        this.fetchShowData(this.$route.params.id)
      }
    }
  },
  methods: {
    ...mapActions('AdmissionsSingle', ['fetchShowData', 'resetState'])
  }
}
</script>
