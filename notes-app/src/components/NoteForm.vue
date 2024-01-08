<template>
  <div class="container mt-5 page-bottom-margin">
    <form v-if="!editingNote" @submit.prevent="submitNote" class="mb-3">
      <div class="mb-3">
        <label for="title" class="form-label">Title:</label>
        <input type="text" id="title" v-model="note.title" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="content" class="form-label">Content:</label>
        <textarea id="content" v-model="note.content" class="form-control" required></textarea>
      </div>

      <div class="mb-3">
        <label class="form-label">Urgency:</label>
        <div class="form-check form-check-inline">
          <input type="radio" id="urgent" value="urgent" v-model="note.urgency" class="form-check-input">
          <label for="urgent" class="form-check-label">Urgent</label>
        </div>
        <div class="form-check form-check-inline">
          <input type="radio" id="notUrgent" value="notUrgent" v-model="note.urgency" class="form-check-input">
          <label for="notUrgent" class="form-check-label">Not Urgent</label>
        </div>
      </div>

      <div class="mb-3">
        <label for="category" class="form-label">Category:</label>
        <select id="category" v-model="note.category" class="form-select">
          <option value="personal">Personal</option>
          <option value="creative">Creative</option>
          <option value="inspiration">Inspiration</option>
        </select>
      </div>

      <div class="mb-3">
        <div class="form-check">
          <input type="checkbox" id="completed" v-model="note.completed" class="form-check-input">
          <label for="completed" class="form-check-label">Completed</label>
        </div>
      </div>

      <button type="submit" class="btn btn-primary">Create Note</button>
    </form>

    <form v-if="editingNote" @submit.prevent="updateNote" class="mb-3">
      <h3>Edit Note</h3>
      <div class="mb-3">
        <label for="editTitle" class="form-label">Title:</label>
        <input type="text" id="editTitle" v-model="editedNote.title" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="editContent" class="form-label">Content:</label>
        <textarea id="editContent" v-model="editedNote.content" class="form-control" required></textarea>
      </div>

      <div class="mb-3">
        <label class="form-label">Urgency:</label>
        <div class="form-check form-check-inline">
          <input type="radio" id="editUrgent" value="urgent" v-model="editedNote.urgency" class="form-check-input">
          <label for="editUrgent" class="form-check-label">Urgent</label>
        </div>
        <div class="form-check form-check-inline">
          <input type="radio" id="editNotUrgent" value="notUrgent" v-model="editedNote.urgency" class="form-check-input">
          <label for="editNotUrgent" class="form-check-label">Not Urgent</label>
        </div>
      </div>

      <div class="mb-3">
        <label for="editCategory" class="form-label">Category:</label>
        <select id="editCategory" v-model="editedNote.category" class="form-select">
          <option value="personal">Personal</option>
          <option value="creative">Creative</option>
          <option value="inspiration">Inspiration</option>
        </select>
      </div>

      <div class="mb-3">
        <div class="form-check">
          <input type="checkbox" id="editCompleted" v-model="editedNote.completed" class="form-check-input">
          <label for="editCompleted" class="form-check-label">Completed</label>
        </div>
      </div>

      <button type="submit" class="btn btn-success">Update Note</button>
      <button type="button" @click="cancelEdit" class="btn btn-secondary">Cancel</button>
    </form>

    <div v-if="savedNotes.length">
      <h2 class="mb-4">Saved Notes</h2>
      <ul class="list-group">
        <li v-for="(note, index) in savedNotes" :key="index" :class="['list-group-item', { 'urgent-note': note.urgency === 'urgent' }]">
          <strong>{{ note.title }}</strong> - {{ note.content }} ({{ note.category }}) - {{ note.urgency }}
          <button @click="editNote(index)" class="btn btn-warning btn-sm mx-2">Edit</button>
          <button @click="deleteNote(index)" class="btn btn-danger btn-sm">Delete</button>
        </li>
      </ul>
    </div>

    <button @click="clearNotes" class="btn btn-secondary mt-4">Clear Notes</button>
  </div>
</template>


<script>
export default {
  data() {
    return {
      note: {
        title: '',
        content: '',
        urgency: '',
        category: 'personal',
        completed: false
      },
      editedNote: {
        title: '',
        content: '',
        urgency: '',
        category: 'personal',
        completed: false
      },
      savedNotes: this.loadNotes(),
      editingNote: null
    };
  },
  methods: {
    submitNote() {
      this.savedNotes.unshift({ ...this.note });
      this.saveNotes();
      console.log('Creating note:', this.note);
      this.note = {
        title: '',
        content: '',
        urgency: '',
        category: 'personal',
        completed: false
      };
    },
    updateNote() {
      this.savedNotes.splice(this.editingNote, 1, { ...this.editedNote });
      this.saveNotes();
      this.editingNote = null;
      this.editedNote = {
        title: '',
        content: '',
        urgency: '',
        category: 'personal',
        completed: false
      };
    },
    editNote(index) {
      this.editingNote = index;
      this.editedNote = { ...this.savedNotes[index] };
    },
    cancelEdit() {
      this.editingNote = null;
      this.editedNote = {
        title: '',
        content: '',
        urgency: '',
        category: 'personal',
        completed: false
      };
    },
    deleteNote(index) {
      this.savedNotes.splice(index, 1);
      this.saveNotes();
    },
    saveNotes() {
      localStorage.setItem('notes', JSON.stringify(this.savedNotes));
    },
    loadNotes() {
      const notes = localStorage.getItem('notes');
      return notes ? JSON.parse(notes) : [];
    },
    clearNotes() {
      this.savedNotes = [];
      localStorage.removeItem('notes');
    }
  }
};
</script>

<style scoped>

.urgent-note {
  background-color: #FFA07A;
}

.page-bottom-margin {
  margin-bottom: 42px;
}

</style>
