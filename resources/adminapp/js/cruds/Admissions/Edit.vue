<template>
  <div class="container-fluid">
    <form @submit.prevent="submitForm">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary card-header-icon">
              <div class="card-icon">
                <i class="material-icons">edit</i>
              </div>
              <h4 class="card-title">
                {{ $t('global.edit') }}
                <strong>{{ $t('cruds.admission.title_singular') }}</strong>
              </h4>
            </div>
            <div class="card-body">
              <back-button></back-button>
            </div>
            <div class="card-body">
              <bootstrap-alert />
              <div class="row">
                <div class="col-md-12">
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.first_name,
                      'is-focused': activeField == 'first_name'
                    }"
                  >
                    <label class="bmd-label-floating required">{{
                      $t('cruds.admission.fields.first_name')
                    }}</label>
                    <input
                      class="form-control"
                      type="text"
                      :value="entry.first_name"
                      @input="updateFirstName"
                      @focus="focusField('first_name')"
                      @blur="clearFocus"
                      required
                    />
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.middle_name,
                      'is-focused': activeField == 'middle_name'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.admission.fields.middle_name')
                    }}</label>
                    <input
                      class="form-control"
                      type="text"
                      :value="entry.middle_name"
                      @input="updateMiddleName"
                      @focus="focusField('middle_name')"
                      @blur="clearFocus"
                    />
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.last_name,
                      'is-focused': activeField == 'last_name'
                    }"
                  >
                    <label class="bmd-label-floating required">{{
                      $t('cruds.admission.fields.last_name')
                    }}</label>
                    <input
                      class="form-control"
                      type="text"
                      :value="entry.last_name"
                      @input="updateLastName"
                      @focus="focusField('last_name')"
                      @blur="clearFocus"
                      required
                    />
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.code_ds_gender,
                      'is-focused': activeField == 'code_ds_gender'
                    }"
                  >
                    <label class="bmd-label-floating required">{{
                      $t('cruds.admission.fields.code_ds_gender')
                    }}</label>
                    <v-select
                      name="code_ds_gender"
                      :key="'code_ds_gender-field'"
                      :value="entry.code_ds_gender"
                      :options="lists.code_ds_gender"
                      :reduce="entry => entry.value"
                      @input="updateCodeDsGender"
                      @search.focus="focusField('code_ds_gender')"
                      @search.blur="clearFocus"
                    />
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.dob,
                      'is-focused': activeField == 'dob'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.admission.fields.dob')
                    }}</label>
                    <datetime-picker
                      class="form-control"
                      type="text"
                      picker="date"
                      :value="entry.dob"
                      @input="updateDob"
                      @focus="focusField('dob')"
                      @blur="clearFocus"
                    >
                    </datetime-picker>
                  </div>
                  <div class="form-group">
                    <label class="required">{{
                      $t('cruds.admission.fields.married')
                    }}</label>
                    <v-radio
                      :value="entry.married"
                      :options="lists.married"
                      @change="updateMarried"
                    >
                    </v-radio>
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.height,
                      'is-focused': activeField == 'height'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.admission.fields.height')
                    }}</label>
                    <input
                      class="form-control"
                      type="number"
                      step="0.01"
                      :value="entry.height"
                      @input="updateHeight"
                      @focus="focusField('height')"
                      @blur="clearFocus"
                    />
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.minimum_income,
                      'is-focused': activeField == 'minimum_income'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.admission.fields.minimum_income')
                    }}</label>
                    <input
                      class="form-control"
                      type="number"
                      step="0.01"
                      :value="entry.minimum_income"
                      @input="updateMinimumIncome"
                      @focus="focusField('minimum_income')"
                      @blur="clearFocus"
                    />
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.date_time,
                      'is-focused': activeField == 'date_time'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.admission.fields.date_time')
                    }}</label>
                    <datetime-picker
                      class="form-control"
                      type="text"
                      :value="entry.date_time"
                      @input="updateDateTime"
                      @focus="focusField('date_time')"
                      @blur="clearFocus"
                    >
                    </datetime-picker>
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.email,
                      'is-focused': activeField == 'email'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.admission.fields.email')
                    }}</label>
                    <input
                      class="form-control"
                      type="text"
                      :value="entry.email"
                      @input="updateEmail"
                      @focus="focusField('email')"
                      @blur="clearFocus"
                    />
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.password,
                      'is-focused': activeField == 'password'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.admission.fields.password')
                    }}</label>
                    <input
                      class="form-control"
                      type="password"
                      :value="entry.password"
                      @input="updatePassword"
                      @focus="focusField('password')"
                      @blur="clearFocus"
                    />
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.size,
                      'is-focused': activeField == 'size'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.admission.fields.size')
                    }}</label>
                    <input
                      class="form-control"
                      type="number"
                      step="1"
                      :value="entry.size"
                      @input="updateSize"
                      @focus="focusField('size')"
                      @blur="clearFocus"
                    />
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.time,
                      'is-focused': activeField == 'time'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.admission.fields.time')
                    }}</label>
                    <datetime-picker
                      class="form-control"
                      type="text"
                      picker="time"
                      :value="entry.time"
                      @input="updateTime"
                      @focus="focusField('time')"
                      @blur="clearFocus"
                    >
                    </datetime-picker>
                  </div>
                  <div class="form-group">
                    <label>{{
                      $t('cruds.admission.fields.multiple_file')
                    }}</label>
                    <attachment
                      :route="getRoute('admissions')"
                      :collection-name="'admission_multiple_file'"
                      :media="entry.multiple_file"
                      :model-id="$route.params.id"
                      :max-file-size="6"
                      @file-uploaded="insertMultipleFileFile"
                      @file-removed="removeMultipleFileFile"
                    />
                  </div>
                  <div class="form-group">
                    <label>{{
                      $t('cruds.admission.fields.single_file')
                    }}</label>
                    <attachment
                      :route="getRoute('admissions')"
                      :collection-name="'admission_single_file'"
                      :media="entry.single_file"
                      :model-id="$route.params.id"
                      :max-file-size="2"
                      @file-uploaded="insertSingleFileFile"
                      @file-removed="removeSingleFileFile"
                      :max-files="1"
                    />
                  </div>
                  <div class="form-group">
                    <label>{{
                      $t('cruds.admission.fields.multiple_photo')
                    }}</label>
                    <attachment
                      :route="getRoute('admissions')"
                      :collection-name="'admission_multiple_photo'"
                      :media="entry.multiple_photo"
                      :model-id="$route.params.id"
                      :max-file-size="3"
                      :component="'pictures'"
                      :accept="'image/*'"
                      @file-uploaded="insertMultiplePhotoFile"
                      @file-removed="removeMultiplePhotoFile"
                    />
                  </div>
                  <div class="form-group">
                    <label>{{
                      $t('cruds.admission.fields.single_photo')
                    }}</label>
                    <attachment
                      :route="getRoute('admissions')"
                      :collection-name="'admission_single_photo'"
                      :media="entry.single_photo"
                      :model-id="$route.params.id"
                      :max-file-size="2"
                      :component="'pictures'"
                      :accept="'image/*'"
                      @file-uploaded="insertSinglePhotoFile"
                      @file-removed="removeSinglePhotoFile"
                      :max-files="1"
                    />
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.belongs_to_id !== null,
                      'is-focused': activeField == 'belongs_to'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.admission.fields.belongs_to')
                    }}</label>
                    <v-select
                      name="belongs_to"
                      label="name"
                      :key="'belongs_to-field'"
                      :value="entry.belongs_to_id"
                      :options="lists.belongs_to"
                      :reduce="entry => entry.id"
                      @input="updateBelongsTo"
                      @search.focus="focusField('belongs_to')"
                      @search.blur="clearFocus"
                    />
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.belongs_to_many.length !== 0,
                      'is-focused': activeField == 'belongs_to_many'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.admission.fields.belongs_to_many')
                    }}</label>
                    <v-select
                      name="belongs_to_many"
                      label="name"
                      :key="'belongs_to_many-field'"
                      :value="entry.belongs_to_many"
                      :options="lists.belongs_to_many"
                      :closeOnSelect="false"
                      multiple
                      @input="updateBelongsToMany"
                      @search.focus="focusField('belongs_to_many')"
                      @search.blur="clearFocus"
                    />
                  </div>
                  <div class="form-group">
                    <label>{{ $t('cruds.admission.fields.text_area') }}</label>
                    <ckeditor
                      :editor="editor"
                      :value="entry.text_area"
                      @input="updateTextArea"
                    >
                    </ckeditor>
                  </div>
                  <div class="form-group form-check">
                    <label class="form-check-label"
                      ><input
                        class="form-check-input"
                        type="checkbox"
                        :value="entry.checkbox"
                        :checked="entry.checkbox"
                        @change="updateCheckbox"
                      /><span class="form-check-sign"
                        ><span class="check"></span></span
                      >{{ $t('cruds.admission.fields.checkbox') }}</label
                    >
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <vue-button-spinner
                class="btn-primary"
                :status="status"
                :isLoading="loading"
                :disabled="loading"
              >
                {{ $t('global.save') }}
              </vue-button-spinner>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import Attachment from '@components/Attachments/Attachment'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic'

export default {
  components: {
    Attachment,
    ClassicEditor
  },
  data() {
    return {
      status: '',
      activeField: '',
      editor: ClassicEditor
    }
  },
  computed: {
    ...mapGetters('AdmissionsSingle', ['entry', 'loading', 'lists'])
  },
  beforeDestroy() {
    this.resetState()
  },
  watch: {
    '$route.params.id': {
      immediate: true,
      handler() {
        this.resetState()
        this.fetchEditData(this.$route.params.id)
      }
    }
  },
  methods: {
    ...mapActions('AdmissionsSingle', [
      'fetchEditData',
      'updateData',
      'resetState',
      'setFirstName',
      'setMiddleName',
      'setLastName',
      'setCodeDsGender',
      'setDob',
      'setMarried',
      'setHeight',
      'setMinimumIncome',
      'setDateTime',
      'setEmail',
      'setPassword',
      'setSize',
      'setTime',
      'insertMultipleFileFile',
      'removeMultipleFileFile',
      'insertSingleFileFile',
      'removeSingleFileFile',
      'insertMultiplePhotoFile',
      'removeMultiplePhotoFile',
      'insertSinglePhotoFile',
      'removeSinglePhotoFile',
      'setBelongsTo',
      'setBelongsToMany',
      'setTextArea',
      'setCheckbox'
    ]),
    updateFirstName(e) {
      this.setFirstName(e.target.value)
    },
    updateMiddleName(e) {
      this.setMiddleName(e.target.value)
    },
    updateLastName(e) {
      this.setLastName(e.target.value)
    },
    updateCodeDsGender(value) {
      this.setCodeDsGender(value)
    },
    updateDob(e) {
      this.setDob(e.target.value)
    },
    updateMarried(value) {
      this.setMarried(value)
    },
    updateHeight(e) {
      this.setHeight(e.target.value)
    },
    updateMinimumIncome(e) {
      this.setMinimumIncome(e.target.value)
    },
    updateDateTime(e) {
      this.setDateTime(e.target.value)
    },
    updateEmail(e) {
      this.setEmail(e.target.value)
    },
    updatePassword(e) {
      this.setPassword(e.target.value)
    },
    updateSize(e) {
      this.setSize(e.target.value)
    },
    updateTime(e) {
      this.setTime(e.target.value)
    },
    updateBelongsTo(value) {
      this.setBelongsTo(value)
    },
    updateBelongsToMany(value) {
      this.setBelongsToMany(value)
    },
    updateTextArea(value) {
      this.setTextArea(value)
    },
    updateCheckbox(e) {
      this.setCheckbox(e.target.checked)
    },
    getRoute(name) {
      return `${axios.defaults.baseURL}${name}/media`
    },
    submitForm() {
      this.updateData()
        .then(() => {
          this.$router.push({ name: 'admissions.index' })
          this.$eventHub.$emit('update-success')
        })
        .catch(error => {
          this.status = 'failed'
          _.delay(() => {
            this.status = ''
          }, 3000)
        })
    },
    focusField(name) {
      this.activeField = name
    },
    clearFocus() {
      this.activeField = ''
    }
  }
}
</script>
