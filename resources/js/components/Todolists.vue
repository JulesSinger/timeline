<template>
  <div id="todolists-page" v-if="todolists">
    <h1 class="text-center mb-5">MES TODOLISTS</h1>


    <div id="todolists-container">
      <div class="todolist" id="create-todolist">
        <div>
          <h3>Créer une todolist</h3>
        </div>

        <div id="inputs">
          <div class="input-container">
            <input type="text" id="name" v-model="insert_form.name" placeholder="nom de la todolist"/>
          </div>

          <div class="input-container">
            <input type="text" id="description" v-model="insert_form.description" placeholder="description de la todolist"/>
          </div>

          <button class="btn btn-markup" @click="callPostTodolist()">Créer</button>
        </div>
      </div>
      <div v-for="todolist in todolists" :key="todolist.id" class="todolist">
          <div class="todolist-title">
            <h3>{{ todolist.name }}</h3>
          </div>
          <div class="todolist-content">
            <p>{{ todolist.description }}</p>
          </div>
          <div class="todolist-actions">
            <router-link :to="{name: 'Todolist', params: { id: todolist.id }}" class="router">
                <img src="/images/eye.png"  alt="delete" class="icon"/>
              </router-link>
            <img src="/images/edit.png" @click="editTodolist(todolist)" />
            <img src="/images/delete.svg"  @click="callDeleteTodolist(todolist.id)" alt="delete" class="icon"/>
          </div>
      </div>
    </div>


  </div>
</template>

<script setup>
import { useTodolist } from '../api/todolist.js'
import { reactive } from 'vue'
const { todolists, getTodolists, deleteTodolist, postTodolist } = useTodolist()

const insert_form = reactive({
    name: '',
    description: '',
})

const callDeleteTodolist = (id) => {
  deleteTodolist(id)
}

const callPostTodolist = () => {
  postTodolist(insert_form)
}

const editTodolist = (todolist) => {
  console.log(todolist.id)
}

getTodolists()

</script>