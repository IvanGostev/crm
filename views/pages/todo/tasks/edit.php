<?php
$titlePage = 'Edit category';
ob_start();
?>
    <div class="card card-success">
        <!-- /.card-header -->
        <div class="card-body">
            <form method="POST" action="/todo/tasks/update">
                <div class="row">
                    <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control" name="title" required
                                   value="<?= $data['task']['title'] ?>">
                            <br>
                            <label>Category</label>
                            <select class="form-control" name="category_id">
                                <?php foreach ($data['categories'] as $category) : ?>
                                    <option value="<?= $category['id'] ?>" <?= $data['task']['category_id'] == $category['id'] ? 'selected' : '' ?>> <?= htmlspecialchars($category['title']) ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>

                    </div>
                    <div class="col-sm-6">
                        <!-- textarea -->
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="description"
                                      rows="5"><?= $data['task']['description'] ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <!-- select -->
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="status">
                                <?php foreach ($data['status'] as $title => $value) : ?>
                                    <option value="<?= $value ?>" <?= $data['task']['status'] === $value ? 'selected' : '' ?>><?= $title ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <!-- select -->
                        <div class="form-group">
                            <label>Priority</label>
                            <select class="form-control" name="priority">
                                <?php foreach ($data['priority'] as $title => $value) : ?>
                                    <option value="<?= $value ?>" <?= $data['task']['priority'] === $value ? 'selected' : '' ?>><?= $title ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <!-- select -->
                        <div class="form-group">
                            <label><i class="far fa-bell"></i> Remind every</label>
                            <select class="form-control" name="reminder_at">
                                <option value="30_minutes">30 minutes</option>
                                <option value="1_hour">1 hour</option>
                                <option value="2_hours">2 hours</option>
                                <option value="12_hours">12 hours</option>
                                <option value="24_hours">24 hours</option>
                                <option value="7_days">7 day</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <!-- select -->
                        <div class="form-group">
                            <label>Finish Date</label>
                            <input type="datetime-local" class="form-control" id="finish_date" name="finish_date"
                                   value="<?= $data['task']['finish_date'] ?>">
                        </div>
                    </div>

                </div>
                <div class="form-group">
                    <label for="tags">Tags</label>
                    <div class="tags-container form-control flex-column">
                        <?php
                        if (isset($data['tags'][0]['title'])) {
                            $tagNames = array_map(function ($tag) {
                                return $tag['title'];
                            }, $data['tags']);
                            foreach ($tagNames as $tagName) {
                                echo "<div class='tag'>
                            <span>$tagName</span>
                            <button type='button'>×</button>
                        </div>";
                            }
                        }
                        ?>
                        <input class="form-control" type="text" id="tag-input">
                    </div>
                    <input class="form-control" type="hidden" name="tags" id="hidden-tags"
                           value="<?= htmlspecialchars(implode(', ', $tagNames)) ?>">
                </div>
                <input type="text" name="id" value="<?= $data['task']['id'] ?>" hidden="hidden">
                <input type="text" name="user_id" value="<?= $_SESSION['user_id'] ?? '' ?>" hidden="hidden">
                <br>
                <br>
                <div class=form-group">
                    <button type="submit" class="btn btn-primary">Update task</button>
                </div>
            </form>
        </div>
    </div>

    <style>
        /* Стилизация тегов на странице редактирования тегов */
        div.tags-container {

        }
        div.tags-container div.tag {
            display: inline-block;
            background: #020202;
            color: #f1f1f1;
            padding: 1px 6px;
            border-radius: 4px;
            margin: 5px 4px;
        }

        div.tags-container div.tag button {
            border: none;
            background: inherit;
            color: #ffffff;
            padding-left: 11px;
            border-left: 1px solid #c1c1c1;
        }

        div.tags-container div.tag span {
            display: inline-block;
            padding-right: 10px;
        }
    </style>
    <script>
        const tagInput = document.querySelector('#tag-input');
        const tagsContainer = document.querySelector('.tags-container');
        const hiddenTags = document.querySelector('#hidden-tags');
        const existingTags = '<?= htmlspecialchars(isset($task['tags']) ? $task['tags'] : '') ?>';

        function createTag(text) {
            const tag = document.createElement('div');
            tag.classList.add('tag');
            const tagText = document.createElement('span');
            tagText.textContent = text;

            const closeButton = document.createElement('button');
            closeButton.innerHTML = '&times;';

            closeButton.addEventListener('click', () => {
                tagsContainer.removeChild(tag);
                updateHiddenTags();
            });

            tag.appendChild(tagText);
            tag.appendChild(closeButton);

            return tag;
        }

        function updateHiddenTags() {
            const tags = tagsContainer.querySelectorAll('.tag span');
            const tagText = Array.from(tags).map(tag => tag.textContent);
            hiddenTags.value = tagText.join(',');
        }

        tagInput.addEventListener('input', (e) => {
            if (e.target.value.includes(',')) {
                const tagText = e.target.value.slice(0, -1).trim();
                if (tagText.length > 1) {
                    const tag = createTag(tagText);
                    tagsContainer.insertBefore(tag, tagInput);
                    updateHiddenTags();
                }
                e.target.value = '';
            }
        });

        tagsContainer.querySelectorAll('.tag button').forEach(button => {
            button.addEventListener('click', () => {
                tagsContainer.removeChild(button.parentElement);
                updateHiddenTags();
            });
        });
    </script>
<?php $content = ob_get_clean();
require_once 'views/layouts/layout.php';
