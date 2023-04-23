<template>
    <div>
        <div class="d-flex justify-content-between align-items center">
            <h4 class="m-0">{{ title }}</h4>
            <slot name="formHeader"></slot>
        </div>
        <div class="card mt-4">
            <div class="card-body">
                <slot name="formBody">
                    <v-client-table :data="data" :columns="columns" :options="options">
                        <template slot="action" slot-scope="props">
                            <button class="btn btn-primary" v-on:click="viewData(props)"><i class="fa fa-binoculars mr-2" aria-hidden="true"></i> View</button>
                            <button class="btn btn-danger" v-on:click="deleteData(props)"><i class="fa fa-trash mr-2" aria-hidden="true"></i> Delete</button>
                        </template>
                    </v-client-table>
                </slot>
            </div>
        </div>
    </div>
</template>

<script>
export default {

    props: {
        title : String,
        data : Array,
        columns : Array,
        options : Object,
    },


    data() {

        return {


        }

    },

    methods: {
        viewData(props) {
            this.$emit('viewData', props);
        },
        
        deleteData(props) {
            this.$emit('deleteData', props);
        },
    }

}

</script>