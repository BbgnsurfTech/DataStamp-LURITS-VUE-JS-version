<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary card-header-icon">
            <div class="card-icon">
              <i class="material-icons">assignment</i>
            </div>
            <h4 class="card-title">
              {{ $t('global.table') }}
              <strong>{{ $t('cruds.admission.title') }}</strong>
            </h4>
          </div>
          <div class="card-body">
            <router-link
              class="btn btn-primary"
              v-if="$can(xprops.permission_prefix + 'create')"
              :to="{ name: xprops.route + '.create' }"
            >
              <i class="material-icons">
                add
              </i>
              {{ $t('global.add') }}
            </router-link>
            <button
              type="button"
              class="btn btn-default"
              @click="fetchIndexData"
              :disabled="loading"
              :class="{ disabled: loading }"
            >
              <i class="material-icons" :class="{ 'fa-spin': loading }">
                refresh
              </i>
              {{ $t('global.refresh') }}
            </button>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="table-overlay" v-show="loading">
                  <div class="table-overlay-container">
                    <material-spinner></material-spinner>
                    <span>Loading...</span>
                  </div>
                </div>
                <datatable
                  :columns="columns"
                  :data="data"
                  :total="total"
                  :query="query"
                  :xprops="xprops"
                  :HeaderSettings="false"
                  :pageSizeOptions="[10, 25, 50, 100]"
                >
                  <global-search :query="query" class="pull-left" />
                  <header-settings :columns="columns" class="pull-right" />
                </datatable>
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
import DatatableActions from '@components/Datatables/DatatableActions'
import TranslatedHeader from '@components/Datatables/TranslatedHeader'
import HeaderSettings from '@components/Datatables/HeaderSettings'
import GlobalSearch from '@components/Datatables/GlobalSearch'
import DatatableEnum from '@components/Datatables/DatatableEnum'
import DatatableAttachments from '@components/Datatables/DatatableAttachments'
import DatatablePictures from '@components/Datatables/DatatablePictures'
import DatatableSingle from '@components/Datatables/DatatableSingle'
import DatatableList from '@components/Datatables/DatatableList'
import DatatableCheckbox from '@components/Datatables/DatatableCheckbox'

export default {
  components: {
    GlobalSearch,
    HeaderSettings
  },
  data() {
    return {
      columns: [
        {
          title: 'cruds.admission.fields.id',
          field: 'id',
          thComp: TranslatedHeader,
          sortable: true,
          colStyle: 'width: 100px;'
        },
        {
          title: 'cruds.admission.fields.first_name',
          field: 'first_name',
          thComp: TranslatedHeader,
          sortable: true
        },
        {
          title: 'cruds.admission.fields.middle_name',
          field: 'middle_name',
          thComp: TranslatedHeader,
          sortable: true
        },
        {
          title: 'cruds.admission.fields.last_name',
          field: 'last_name',
          thComp: TranslatedHeader,
          sortable: true
        },
        {
          title: 'cruds.admission.fields.code_ds_gender',
          field: 'code_ds_gender',
          thComp: TranslatedHeader,
          sortable: true,
          tdComp: DatatableEnum
        },
        {
          title: 'cruds.admission.fields.dob',
          field: 'dob',
          thComp: TranslatedHeader,
          sortable: true
        },
        {
          title: 'cruds.admission.fields.married',
          field: 'married',
          thComp: TranslatedHeader,
          sortable: true,
          tdComp: DatatableEnum
        },
        {
          title: 'cruds.admission.fields.height',
          field: 'height',
          thComp: TranslatedHeader,
          sortable: true
        },
        {
          title: 'cruds.admission.fields.minimum_income',
          field: 'minimum_income',
          thComp: TranslatedHeader,
          sortable: true
        },
        {
          title: 'cruds.admission.fields.date_time',
          field: 'date_time',
          thComp: TranslatedHeader,
          sortable: true
        },
        {
          title: 'cruds.admission.fields.email',
          field: 'email',
          thComp: TranslatedHeader,
          sortable: true
        },
        {
          title: 'cruds.admission.fields.size',
          field: 'size',
          thComp: TranslatedHeader,
          sortable: true
        },
        {
          title: 'cruds.admission.fields.time',
          field: 'time',
          thComp: TranslatedHeader,
          sortable: true
        },
        {
          title: 'cruds.admission.fields.multiple_file',
          field: 'multiple_file',
          thComp: TranslatedHeader,
          tdComp: DatatableAttachments
        },
        {
          title: 'cruds.admission.fields.single_file',
          field: 'single_file',
          thComp: TranslatedHeader,
          tdComp: DatatableAttachments
        },
        {
          title: 'cruds.admission.fields.multiple_photo',
          field: 'multiple_photo',
          thComp: TranslatedHeader,
          tdComp: DatatablePictures
        },
        {
          title: 'cruds.admission.fields.single_photo',
          field: 'single_photo',
          thComp: TranslatedHeader,
          tdComp: DatatablePictures
        },
        {
          title: 'cruds.admission.fields.belongs_to',
          field: 'belongs_to.name',
          thComp: TranslatedHeader,
          tdComp: DatatableSingle,
          sortable: true
        },
        {
          title: 'cruds.admission.fields.belongs_to_many',
          field: 'belongs_to_many.name',
          thComp: TranslatedHeader,
          tdComp: DatatableList
        },
        {
          title: 'cruds.admission.fields.checkbox',
          field: 'checkbox',
          thComp: TranslatedHeader,
          tdComp: DatatableCheckbox,
          sortable: true
        },
        {
          title: 'global.actions',
          thComp: TranslatedHeader,
          tdComp: DatatableActions,
          visible: true,
          thClass: 'text-right',
          tdClass: 'text-right td-actions',
          colStyle: 'width: 150px;'
        }
      ],
      query: { sort: 'id', order: 'asc', limit: 50, s: '' },
      xprops: {
        module: 'AdmissionsIndex',
        route: 'admissions',
        permission_prefix: 'admission_'
      }
    }
  },
  beforeDestroy() {
    this.resetState()
  },
  computed: {
    ...mapGetters('AdmissionsIndex', ['data', 'total', 'loading'])
  },
  watch: {
    query: {
      handler(query) {
        this.setQuery(query)
        this.fetchIndexData()
      },
      deep: true
    }
  },
  methods: {
    ...mapActions('AdmissionsIndex', [
      'fetchIndexData',
      'setQuery',
      'resetState'
    ])
  }
}
</script>
