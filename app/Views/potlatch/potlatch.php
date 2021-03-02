<h1><?= $potlatch['title'] ?></h1>
<p><?= $potlatch['description'] ?></p>
<header style="justify-content: flex-start;">
    <h2>Items</h2>
    <?php if($isOwner): ?>
        <button onclick="toggleOverlay()">Add Item</button>
    <?php endif; ?>
</header>
<items>
    <?php foreach($items as $item): ?>
        <card>
            <header><?= $item['title'] ?></header>
        </card>
    <?php endforeach; ?>
</items>
<overlay id="overlay_create">
    <content>
        <header>
            <h1>Add Item</h1>
            <button class="close" onclick="toggleOverlay()">Close</button>
        </header>
        <?= form_open('potlatch/createItem', ['autocomplete', 'on']) ?>
            <label for="title">Title</label>
            <input type="text" id="title" name="title" value="" size="50" />
            <label for="description">Description</label>
            <textarea id="description" name="description" value="" rows="9" maxlength="1000"></textarea>
            <button type="submit">Create</button>
            <input name="potlatch_id" type="number" value="<?= $potlatch['id'] ?>" hidden/>
        </form>
    </content>
</overlay>
<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
<script>
    let overlayT = false;
    function toggleOverlay(){
        if(overlayT){
            $('#overlay_create').css('display', 'none');
            overlayT = false;
        }else{
            $('#overlay_create').css('display', 'block');
            overlayT = true;
        }
    }
</script>