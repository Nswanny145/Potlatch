<header>
    <h1>Managed Potlatchs</h1><button onclick="toggleOverlay()">Create Potlatch</button>
</header>
<content>
    <?php if(isset($managed) && !empty($managed)): ?>
        <?php foreach($managed as $potlatch): ?>
            <card>
                <header><?= $potlatch['title'] ?></header>
                <content><?= $potlatch['description'] ?></content>
            </card>
        <?php endforeach; ?>
    <?php else: ?>
        <p>You have not created any Potlatchs yet.</p>
    <?php endif; ?>
</content>
<header>
    <h1>Joined Potlatchs</h1><button>Join Potlatch</button>
</header>
<content>
    <?php if(isset($joined) && !empty($joined)): ?>
        <?php foreach($joined as $potlatch): ?>
            <card>
                <header><?= $potlatch['title'] ?></header>
                <content><?= $potlatch['description'] ?></content>
            </card>
        <?php endforeach; ?>
    <?php else: ?>
        <p>You have not joined any Potlatchs yet.</p>
    <?php endif; ?>
</content>
<overlay id="overlay_create">
    <?= form_open('potlatch/create', ['autocomplete', 'on']) ?>
        <button class="close" onclick="toggleOverlay()">Close</button>
        <h1>Create Potlatch</h1>
        <label for="title">Title</label>
        <input type="text" id="title" name="title" value="" size="50" />
        <label for="description">Description</label>
        <textarea id="description" name="description" value="" rows="9" maxlength="400"></textarea>
        <button type="submit">Create</button>
    </form>
</overlay>
<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
<script>
    let overlayT = false;
    function toggleOverlay(e){
        e.preventDefault();
        if(overlayT){
            $('#overlay_create').css('display', 'none');
            overlayT = false;
        }else{
            $('#overlay_create').css('display', 'block');
            overlayT = true;
        }
    }
</script>