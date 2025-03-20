
<style>
        body { background-color: #eef2f7; font-family: 'Poppins', sans-serif; }
        .card { border-radius: 14px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); border: none; }
        .dark-mode { background-color: #1e1e1e; color: white; }
        .dark-mode .card { background: #2c2c2c; color: white; }
        .seo-score { font-weight: bold; color: green; }
        .status-badge { padding: 5px 10px; border-radius: 8px; font-size: 14px; }
        .status-draft { background: orange; color: white; }
        .status-published { background: green; color: white; }
        .status-archived { background: red; color: white; }
        /* Apply red color to all buttons */

        #dropZone { min-height: 150px; background: #f8f9fa; border: 2px dashed #007bff; text-align: center; padding: 20px; }
        #dropZone.dragover { background: #d1e7ff; }
        .draggable { padding: 10px; margin: 5px; background: #007bff; color: white; cursor: grab; border-radius: 6px; }
    </style>

@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <div class="container mt-5">
        <div class="row">
            <!-- Drag & Drop -->
            <div class="col-md-4">
                <div class="card p-4">
                    <h4>Drag & Drop Elements</h4>
                    <div id="elements">
                        <div class="draggable" draggable="true" ondragstart="drag(event)" style="background-color: rgba(162, 32, 26, 1);">Text Box</div>
                        <div class="draggable" draggable="true" ondragstart="drag(event)" style="background-color: rgba(162, 32, 26, 1);">Image</div>
                        <div class="draggable" draggable="true" ondragstart="drag(event)" style="background-color: rgba(162, 32, 26, 1);">Button</div>
                    </div>
                </div>
</div>
            <!-- Drop Zone -->
            <div class="col-md-8">
                <div class="card p-4">
                    <h4>Page Editor - Drag & Drop</h4>
                    <div id="dropZone" style="border-color: rgba(162, 32, 26, 1);" ondragover="allowDrop(event)" ondrop="handleDrop(event)">
    Drop items here...
    <div class="progress mt-3" style="display: none;">
        <div id="progressBar" class="progress-bar bg-danger" style="width: 0%;">0%</div>
    </div>
    <div id="imagePreviewContainer" class="mt-3"></div>
</div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Content Editor -->
            <div class="col-md-8">
                <div class="card p-4">
                    <h4>Content Editor</h4>
                    <div id="editor" class="border p-2"></div>
                    <button class="btn mt-3 text-white" style="background-color: rgba(162, 32, 26, 1);" onclick="saveContent()">Save Content</button>
                </div>

            </div>

            <!-- SEO & Status -->
            <div class="col-md-4">
                <div class="card p-4">
                    <h4>SEO Settings</h4>
                    <input type="text" id="metaTitle" class="form-control mb-2" placeholder="Meta Title" oninput="updateSeoScore()">
                    <textarea id="metaDescription" class="form-control mb-2" placeholder="Meta Description" oninput="updateSeoScore()"></textarea>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script>
        var quill = new Quill('#editor', { theme: 'snow' });

        function previewImage() {
            var file = document.getElementById('imageUpload').files[0];
            var preview = document.getElementById('imagePreview');
            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) { preview.src = e.target.result; preview.style.display = 'block'; };
                reader.readAsDataURL(file);
            }
        }

        function updateSeoScore() {
            var title = document.getElementById('metaTitle').value.length;
            var description = document.getElementById('metaDescription').value.length;
            var score = Math.min(100, (title + description) / 2);
            document.getElementById('seoScore').innerText = score.toFixed(0);
        }

        function toggleDarkMode() {
            document.body.classList.toggle('dark-mode');
            localStorage.setItem('darkMode', document.body.classList.contains('dark-mode'));
        }

        function allowDrop(event) {
            event.preventDefault();
            document.getElementById("dropZone").classList.add("dragover");
        }

        function drag(event) {
            event.dataTransfer.setData("text", event.target.innerText);
        }

        function handleDrop(event) {
            event.preventDefault();
            var data = event.dataTransfer.getData("text");
            var newElement = document.createElement("p");
            newElement.innerText = data;
            newElement.classList.add("p-2", "border", "bg-light");
            event.target.appendChild(newElement);
        }

        function saveContent() {
            localStorage.setItem('pageContent', quill.root.innerHTML);
            alert('Content Saved!');
        }

        window.onload = function() {
            if (localStorage.getItem('darkMode') === 'true') document.body.classList.add('dark-mode');
            var savedContent = localStorage.getItem('pageContent');
            if (savedContent) quill.root.innerHTML = savedContent;
        };
    </script>


<script>
    function allowDrop(event) {
        event.preventDefault();
        document.getElementById("dropZone").classList.add("dragover");
    }

    function handleDrop(event) {
        event.preventDefault();
        document.getElementById("dropZone").classList.remove("dragover");

        // Show Progress Bar
        var progressBar = document.querySelector("#dropZone .progress");
        var progressFill = document.getElementById("progressBar");
        progressBar.style.display = "block";
        progressFill.style.width = "0%";
        progressFill.innerText = "0%";

        let progress = 0;
        let interval = setInterval(function () {
            progress += 20;
            progressFill.style.width = progress + "%";
            progressFill.innerText = progress + "%";

            if (progress >= 100) {
                clearInterval(interval);
                progressBar.style.display = "none";
            }
        }, 200);

        // Handle Image File Drop
        if (event.dataTransfer.files.length > 0) {
            let file = event.dataTransfer.files[0];
            if (file.type.startsWith("image/")) {
                let reader = new FileReader();
                reader.onload = function (e) {
                    let img = document.createElement("img");
                    img.src = e.target.result;
                    img.classList.add("img-fluid", "mt-2");
                    img.style.maxWidth = "100%";
                    img.style.borderRadius = "8px";
                    document.getElementById("imagePreviewContainer").innerHTML = "";
                    document.getElementById("imagePreviewContainer").appendChild(img);
                };
                reader.readAsDataURL(file);
            }
        } else {
            // Handle Text Drop
            var data = event.dataTransfer.getData("text");
            if (data) {
                var newElement = document.createElement("p");
                newElement.innerText = data;
                newElement.classList.add("p-2", "border", "bg-light");
                document.getElementById("dropZone").appendChild(newElement);
            }
        }
    }
</script>
@endsection
