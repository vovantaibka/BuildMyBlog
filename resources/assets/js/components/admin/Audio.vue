<template>
  <b-container fluid>
    <h2>All Audios</h2>
    <div class="button-create-new">
      <b-button type="button" @click.stop="showModalCreate($event.target)" variant="primary" size="sm" class="create">
        <svg class="svg-icon" viewBox="0 0 20 20">
          <path d="M14.613,10c0,0.23-0.188,0.419-0.419,0.419H10.42v3.774c0,0.23-0.189,0.42-0.42,0.42s-0.419-0.189-0.419-0.42v-3.774H5.806c-0.23,0-0.419-0.189-0.419-0.419s0.189-0.419,0.419-0.419h3.775V5.806c0-0.23,0.189-0.419,0.419-0.419s0.42,0.189,0.42,0.419v3.775h3.774C14.425,9.581,14.613,9.77,14.613,10 M17.969,10c0,4.401-3.567,7.969-7.969,7.969c-4.402,0-7.969-3.567-7.969-7.969c0-4.402,3.567-7.969,7.969-7.969C14.401,2.031,17.969,5.598,17.969,10 M17.13,10c0-3.932-3.198-7.13-7.13-7.13S2.87,6.068,2.87,10c0,3.933,3.198,7.13,7.13,7.13S17.13,13.933,17.13,10"></path>
        </svg>
        Create Audio
      </b-button>
    </div>  
    <div class="table-responsive">
      <b-table striped
      hover
      :items="audios"
      :fields="fields"
      :current-page="currentPage"
      :per-page="perPage"
      >
      <template slot="image" slot-scope="data">
        <b-img thumbnail fluid :src="data.value" alt="Thumbnail"/>
      </template>

      <template slot="actions" slot-scope="data">
        <b-button size="sm" @click.stop="showModalEdit(data.item, data.index, $event.target)" class="mr-1">
          Edit
        </b-button>
        <b-button size="sm" @click.stop="deleteAudio(data.item, data.index)">
          Delete
        </b-button>
      </template>
      </b-table>
    </div>
    <b-row no-gutters>
      <b-col md="4" offset-md="2" class="my-1">
        <b-pagination side="md" :total-rows="totalRows" v-model="currentPage" :per-page="perPage"></b-pagination>
      </b-col>
      <b-col md="4" class="my-1">
        <b-form-group horizontal label="Per page" class="mb-0">
          <b-form-select :options="pageOptions" v-model="perPage"></b-form-select>
        </b-form-group>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
export default {
  data: function() {
    return {
      audios: [],
      fields: [
      {
        isRowHeader: true,
        key: 'id',
        sortable: true,
        variant: 'primary'
      },
      {
        key: 'image',
        sortable: false,
        class: 'img',
        formatter: (value) => {
          return "./imgs/" + value
        }
      },
      {
        key: 'title',
        sortable: false
      },
      {
        key: 'link',
        sortable: false,
        formatter: (value) => {
          return value.slice(0, 50) + (value.length > 50 ? "..." : "");
        }
      },
      {
        key: 'created_at',
        sortable: false,
        formatter: (value) => { 
          return new Date(value).toLocaleDateString("en-US"); 
        }
      },
      {
        key: 'updated_at',
        sortable: false,
        formatter: (value) => { 
          return new Date(value).toLocaleDateString("en-US"); 
        }
      },
      {
        key: 'actions',
        label: 'Actions',
        'class': 'text-center btn-action-group'
      }
      ],
      currentPage: 1,
      perPage: 5,
      totalRows: null,
      pageOptions: [5, 10, 20]
    }
  },
  mounted() {
    var app = this;
    axios.get('/api/audio')
    .then(function(resp) {
      app.audios = resp.data
      app.totalRows = resp.data.length
    }).catch(function(resp) {
      console.log(resp)
    })
  },
  methods: {
    showModalCreate(button) {
    },
    showModalEdit(item, index, button) {

    },
    deleteAudio(item, index) {

    }
  }
}
</script>

<style type="text/css">
.img {
  width: 100px;
}
.btn-action-group {
  width: 150px;
}
</style>