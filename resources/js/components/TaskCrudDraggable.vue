<template>

        <table class="table table-striped">
          <thead>
            <tr scope="col" style="width: 100%;">
                <!-- <th scope="col">Order</th> -->
                <td>
                    <tr scope="col" style="width: 100%;">                
                        <th scope="col" style="width: 10%;">Title</th>
                        <th scope="col" style="width: 58%;">Details</th>
                        <th scope="col" style="width: 7%;">Completed</th>
                        <!-- <th scope="col" style="width: 7%;">Action</th> -->
                        <th scope="col" style="width: 15%;">Action</th>
                        <th scope="col" style="width: 5%;">Sort</th>
                    </tr>
                </td>
            </tr>
          </thead>
          <!-- <tbody> -->          
              <draggable :list="tasksNew" :options="{animation:200}" :element="'tbody'" @change="update">
     
                <tr scope="col" style="width: 100%;" v-for="(task, index) in tasksNew">

                    <td>
                        
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" :id="'heading'+task.order_of_tasks">
                                    <h4 class="panel-title">
                                        
                                            <tr scope="col" style="width: 100%;">
                                                <!-- <td>{{ task.order_of_tasks }}</td> -->
                                                <td scope="col" style="width: 10%;">{{ task.name }}</td>
                                                <td scope="col" style="width: 58%;">
                                                    <div style="color: #4286f4; font-weight: normal; font-size: 18px;">
                                                        {{ task.details }} {{ task.id }}
                                                    </div>
                                                </td>
                                                <td scope="col" style="width: 7%;">
                                                    <div class="percent" v-if="task.completed">

                                                    {{ task.completed }}%

                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" :style="'width:'+task.completed+'%'">
                                                          <p style="margin: 0 auto; color: rgba(0, 0, 0, 0.30);"> &nbsp;  {{ task.completed }}% Complete (success)</p> 
                                                        </div>
                                                    </div>

                                                    </div>
                                                </td>
                                                <td scope="col" style="width: 15%;">
                                                    <!-- {{ task.id }} -->
                                                    <a :href="'edit/' + task.id" class="btn btn-primary">Edit</a>
                                                
                                                    <form :action="'delete/' + task.id" method="POST" style="display: none;" :id="'delete-form-'+ task.id ">
                                                
                                                        <input type="hidden" name="_token" :value="csrf">
                                                
                                                        <input type="hidden" name="_method" value="delete">
                                                
                                                    </form>
                                                    <!-- <button type="submit" class="btn btn-danger">Delete</button> -->
                                                    <button onclick="if (confirm('Are you sure to delete this!?')){
                                                    event.preventDefault();
                                                    document.getElementById('delete-form-'+task.id).submit();
                                                    } else{
                                                        event.preventDefault();
                                                    }" class="btn btn-danger">Delete</button>
                                                </td>
                                                <!-- 
                                                <a class="btn btn-primary" href="{{ route('edit', $task->id) }}">Edit</a>
                                                <form method="post" id="delete-form-{{ $task->id }}" action="{{ route('delete', $task->id ) }}" style="display: none;">
                                                    @csrf
                                                    {{ method_field('delete') }}
                                                </form>
                                                <button onclick="if (confirm('Are you sure to delete this!?')){
                                                    event.preventDefault();
                                                    document.getElementById('delete-form-{{ $task->id }}').submit();
                                                } else{
                                                    event.preventDefault();
                                                }" class="btn btn-danger">Delete</button>
                                                -->

                                                <td scope="col" style="width: 5%;"><i class="fa fa-arrows my-handle"></i></td>
                                            </tr>
                                        
                                    </h4>
                                </div>
                                <div :id="'faq'+task.order_of_tasks" class="panel-collapse collapse in" role="tabpanel" :aria-labelledby="'heading'+task.order_of_tasks">
                                    <div class="panel-body">
                                        <a href="">Comments here</a>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </td>


                </tr>


                <br>
              </draggable>
          <!-- </tbody> -->
        </table>

        

</template>

<script>

    import draggable from 'vuedraggable'

    var xx = 'test text ';

    export default {

        components: {
            draggable
        },

        props: ['tasks'],

        data(){
            return{
                tasksNew: this.tasks,
                text: xx,
                showCollapse: false,
                csrf: document.head.querySelector('meta[name="csrf-token"]').content

            }
        },

        methods: {
            update(){
                // console.log('Updating ... .. .');

                this.tasksNew.map((task, index) => {
                    task.order_of_tasks = index + 1;
                })


                axios.put('/updateAll', {
                    tasks: this.tasksNew
                }).then((response) => {
                    console.log(response.data);
                }).catch((error) => {
                    console.log(error);
                })


            }
        },

        mounted() {
            console.log('Component mounted.')
        },
    }
    
</script>
