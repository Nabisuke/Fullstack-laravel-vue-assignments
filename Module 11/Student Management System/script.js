let students = [];
let editingIndex = -1;

function init() {
    loadStudents();
    displayStudents();
    setupEventListeners();
}

function setupEventListeners() {
    const form = document.getElementById('studentForm');
    if (form) {
        form.addEventListener('submit', handleFormSubmit);
    }

    const cancelBtn = document.getElementById('cancelBtn');
    if (cancelBtn) {
        cancelBtn.addEventListener('click', handleCancel);
    }
}

function handleFormSubmit(e) {
    e.preventDefault();
    
    const nameInput = document.getElementById('studentName');
    const ageInput = document.getElementById('studentAge');
    const gradeInput = document.getElementById('studentGrade');
    const classInput = document.getElementById('studentClass');

    if (!nameInput.value.trim() || !ageInput.value || !gradeInput.value) {
        alert('Please fill in all required fields (Name, Age, Grade)');
        return;
    }

    const student = {
        id: editingIndex === -1 ? Date.now() : students[editingIndex].id,
        name: nameInput.value.trim(),
        age: parseInt(ageInput.value),
        grade: parseFloat(gradeInput.value),
        class: classInput.value
    };

    if (editingIndex === -1) {
        students.push(student);
        alert('Student added successfully!');
    } else {
        students[editingIndex] = student;
        editingIndex = -1;
        document.getElementById('formTitle').textContent = 'Add New Student';
        document.getElementById('submitBtn').textContent = 'Add Student';
        document.getElementById('cancelBtn').style.display = 'none';
        alert('Student updated successfully!');
    }

    saveStudents();
    displayStudents();
    e.target.reset();
}

function handleCancel() {
    editingIndex = -1;
    document.getElementById('formTitle').textContent = 'Add New Student';
    document.getElementById('submitBtn').textContent = 'Add Student';
    document.getElementById('cancelBtn').style.display = 'none';
    document.getElementById('studentForm').reset();
}


if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
} else {
    init();
}



function displayStudents(searchTerm = '') {
    const container = document.getElementById('tableContainer');
    
    let filteredStudents = students;
    if (searchTerm) {
        filteredStudents = students.filter(student => 
            student.name.toLowerCase().includes(searchTerm) ||
            student.email.toLowerCase().includes(searchTerm) ||
            student.class.toLowerCase().includes(searchTerm)
        );
    }

    if (filteredStudents.length === 0) {
        container.innerHTML = `
            <div class="empty-state">
                <p>No students found</p>
            </div>
        `;
        return;
    }

    let tableHTML = `
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Grade</th>
                    <th>Class</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
    `;

    students.forEach((student, index) => {
        tableHTML += `
            <tr>
                <td><strong>${student.name}</strong></td>
                <td>${student.age}</td>
                <td>${student.grade.toFixed(2)}</td>
                <td>${student.class || 'N/A'}</td>
                <td class="actions">
                    <button class="btn btn-edit" onclick="editStudent(${index})">Edit</button>
                    <button class="btn btn-delete" onclick="deleteStudent(${index})">Delete</button>
                </td>
            </tr>
        `;
    });

    tableHTML += `
            </tbody>
        </table>
    `;

    container.innerHTML = tableHTML;
}

function editStudent(index) {
    editingIndex = index;
    const student = students[index];

    document.getElementById('studentName').value = student.name;
    document.getElementById('studentAge').value = student.age;
    document.getElementById('studentGrade').value = student.grade;
    document.getElementById('studentClass').value = student.class;

    document.getElementById('formTitle').textContent = 'Edit Student';
    document.getElementById('submitBtn').textContent = 'Update Student';
    document.getElementById('submitBtn').style.backgroundColor = "#27ae60";
    document.getElementById('submitBtn').style.color = "white";

    document.getElementById('cancelBtn').style.display = 'inline-block';

    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function deleteStudent(index) {
    if (confirm(`Are you sure you want to delete ${students[index].name}?`)) {
        students.splice(index, 1);
        saveStudents();
        displayStudents();
    }
}

function saveStudents() {
    localStorage.setItem('students', JSON.stringify(students));
}

function loadStudents() {
    const stored = localStorage.getItem('students');
    if (stored) {
        students = JSON.parse(stored);
    }
}