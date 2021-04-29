<header>
    <h1>Managed Potlatchs</h1><button onclick="toggleOverlay()">Create Potlatch</button>
</header>
<content class="flex">
    <?php if(isset($managed) && !empty($managed)): ?>
        <?php foreach($managed as $potlatch): ?>
            <?= view('potlatch/components/potlatch_card.php', $potlatch) ?>
        <?php endforeach; ?>
    <?php else: ?>
        You have not created any Potlatchs yet.
    <?php endif; ?>
</content>
<header>
    <h1>Joined Potlatchs</h1>
    <?= form_open('potlatch/JoinPotlatch', ['style', 'display: inline-flex!important;']) ?>
        <input type="text" name="code" placeholder="Invite Code" required/><button>Join Potlatch</button>
    </form>
</header>
<content class="flex">
    <?php if(isset($joined) && !empty($joined)): ?>
        <?php foreach($joined as $potlatch): ?>
            <?= view('potlatch/components/potlatch_card.php', $potlatch) ?>
        <?php endforeach; ?>
    <?php else: ?>
        You have not joined any Potlatchs yet.
    <?php endif; ?>
</content>
<!-- Overlays -->
<overlay id="overlay_create">
    <content>
        <button class="close" onclick="toggleOverlay()">Close</button>
        <?= form_open('potlatch/createPotlatch', ['autocomplete', 'on']) ?>
            <h1>Create Potlatch</h1>
            <label for="title">Title</label>
            <input type="text" id="title" name="title" value="" size="50" />
            <label for="description">Description</label>
            <textarea id="description" name="description" value="" rows="9" maxlength="400"></textarea>
            <button type="submit">Create</button>
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