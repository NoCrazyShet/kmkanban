<template>
    <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Quote</th>
                    <th>Order</th>
                    <th>Visibility</th>
                </tr>
            </thead>
            <draggable :list="testlist" :options="{animation:200}" :element="'tbody'" @change="update">
                <tr v-for="item in testlistNew" :key="item.id" class="my-handle">
                    <td>{{item.id}}</td>
                    <td>{{item.title}}</td>
                    <td>{{item.quote}}</td>
                    <td>{{item.order}}</td>
                    <td>{{item.visibility}}</td>
                </tr>
            </draggable>
    </table>
</template>

<script>
    import draggable from 'vuedraggable'
    export default {
        components: {
            draggable
        },
        props: ['testlist'],

        data() {
            return {
                testlistNew: this.testlist,
                csrf: document.head.querySelector('meta[name="csrf-token"]').content
            }
        },

        methods: {
            update() {
                this.testlistNew.map((testlist, index) => {
                    testlist.order = index + 1;
                })

                axios.put('/update', {
                    testlist: this.testlistNew
                }).then((response) => {
                    //success
                })
            }
        },

        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
