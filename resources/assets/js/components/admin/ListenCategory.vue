<template>
	<b-container fluid>
		<h2>All Categories</h2>
		<div class="button-create-new">
			<b-button type="button" @click.stop="showModalCreate($event.target)" variant="primary" size="sm" class="create">
				<svg class="svg-icon" viewBox="0 0 20 20">
					<path d="M14.613,10c0,0.23-0.188,0.419-0.419,0.419H10.42v3.774c0,0.23-0.189,0.42-0.42,0.42s-0.419-0.189-0.419-0.42v-3.774H5.806c-0.23,0-0.419-0.189-0.419-0.419s0.189-0.419,0.419-0.419h3.775V5.806c0-0.23,0.189-0.419,0.419-0.419s0.42,0.189,0.42,0.419v3.775h3.774C14.425,9.581,14.613,9.77,14.613,10 M17.969,10c0,4.401-3.567,7.969-7.969,7.969c-4.402,0-7.969-3.567-7.969-7.969c0-4.402,3.567-7.969,7.969-7.969C14.401,2.031,17.969,5.598,17.969,10 M17.13,10c0-3.932-3.198-7.13-7.13-7.13S2.87,6.068,2.87,10c0,3.933,3.198,7.13,7.13,7.13S17.13,13.933,17.13,10"></path>
				</svg>
				Create Category
			</b-button>
		</div>
		<div class="table-responsive">
			<b-table striped 
				hover 
				:items="categories" 
				:fields="fields"
				:current-page="currentPage"
				:per-page="perPage">
<!-- 				<template slot="created_at" slot-scope="data">
					{{ data.value }}
				</template>
				<template slot="updated_at" slot-scope="data">
					{{ data.value }}
				</template> -->
				<template slot="actions" slot-scope="data">
					<b-button size="sm" @click.stop="showModalEdit(data.item, data.index, $event.target)" class="mr-1">
						Edit
					</b-button>
					<b-button size="sm" @click.stop="deleteCategory(data.item, data.index)">
						Delete
					</b-button>
				</template>
			</b-table>
		</div>
		<b-row no-gutters>
			<b-col md="4" offset-md="2" class="my-1">
				<b-pagination size="md" :total-rows="totalRows" v-model="currentPage" :per-page="perPage"></b-pagination>
			</b-col>
			<b-col md="4" class="my-1">
				<b-form-group horizontal label="Per page" class="mb-0">
					<b-form-select :options="pageOptions" v-model="perPage"></b-form-select>
				</b-form-group>
			</b-col>
		</b-row>

		<!-- Modal Create & Edit -->
		<b-modal id="modalCE"
      @shown="focusInput"
			@ok="handleOk"
      @hidden="resetModalCE"
			:title="modalCE.title"
			ok-only>
			<form @submit.stop.prevent="handleSubmitFormEdit">
				<b-form-input ref="focusThis" 
                      type="text"
					            v-model="categoryName"
                      :state="stateCategoryName"
                      aria-describedby="inputCategoryNameFeedback"
                      placeholder="Enter category name"
					></b-form-input>
          <b-form-invalid-feedback id="inputCategoryNameFeedback">
            Enter at least 3 letters
          </b-form-invalid-feedback>
			</form>
		</b-modal>
	</b-container>
</template>

<script>
export default {
    computed: {
      stateCategoryName() {
        return this.categoryName.length > 2 ? true : false
      }
    },
  	data: function() {
  		return {
  			categories: [],
  			fields: [
  				{
            isRowHeader: true,
  					key: 'id',
  					sortable: true,
  					variant: 'primary'
  				},
  				{
  					key: 'name',
  					sortable: true
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
  					'class': 'text-center'
  				}
  			],
  			currentPage: 1,
  			perPage: 5,
  			totalRows: null,
  			pageOptions: [5, 10, 20],
  			modalCE: { title: ''},
  			categoryName: '',
  			categoryId: '',
        categoryIndex: '',
        isCreate: false
  		}
  	},
  	mounted() {
  		var app = this
  		axios.get('/api/categoriesaudio')
  			.then(function(resp) {
  				app.categories = resp.data
  				app.totalRows = resp.data.length
  			})
  			.catch(function(resp) {
  				console.log(resp)
  				// alert("Could not load categories audio")
  			});
  	},
  	methods: {
      showModalCreate(button) {
        this.modalCE.title = 'Create Category'
        
        this.isCreate = true;
        this.$root.$emit('bv::show::modal', 'modalCE', button)
      },
  		showModalEdit(item, index, button) {
        this.modalCE.title = 'Edit Category'
  			
        this.categoryName = item.name
  			this.categoryId = item.id
        this.categoryIndex = index

        this.isCreate = false;

      	this.$root.$emit('bv::show::modal', 'modalCE', button)
  		},
  		handleOk(evt) {
  			evt.preventDefault()

      	if (!this.categoryName) {
        	alert('Please enter your name')
      	} else {
        	this.handleSubmitFormEdit(evt.target)
      	}
  		},
  		handleSubmitFormEdit(button) {
  			var app = this
  			var newCategory = {
          'name': this.categoryName
        };
        
        if(app.isCreate) {
          axios.post('/api/categoriesaudio', newCategory).then(
            function(resp) {  
              app.categories.push(resp.data)
              app.totalRows = app.categories.length
            }).catch(function(resp) {
              console.log(resp)
            });
        } else {
          var index = app.categoryIndex

          axios.patch('/api/categoriesaudio/' + app.categoryId, newCategory).then(function(resp) {
            app.categories.splice(index, 1, resp.data)
          }).catch(function(resp) {
            console.log(resp)
          })
        }
  			
        this.$root.$emit('bv::hide::modal', 'modalCE', button)
  		},
      deleteCategory(item, index) {
        if(confirm("Do you really want to delete it?")) {
          var app = this
          app.categoryId = item.id
          axios.delete('/api/categoriesaudio/' + app.categoryId).then(
            function(resp) {
            app.categories.splice(((app.currentPage - 1) * app.perPage + index), 1)
            app.totalRows = app.categories.length
          }).catch(function(resp) {
            console.log(resp);
          });
        }
      },
      focusInput() {
        this.$refs.focusThis.focus()
      },
  		resetModalCE() {
        this.categoryName = ''
        this.categoryId = ''
        this.categoryIndex = ''
    	}
  	}
}
</script>