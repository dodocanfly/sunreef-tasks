<?php

namespace Dodocanfly\SunreefTasks\Task3;

class Tree
{
    private array $list;


    public function __construct(array $list)
    {
        $this->list = $list;
    }


    private function getChildrenOf(int $parentId): array
    {
        return array_filter($this->list, function ($v) use ($parentId) {
            return $v['parent'] === $parentId;
        });
    }


    private function getFirstLevel(): array
    {
        return $this->getChildrenOf(0);
    }


    private function listHasFirstLevel(): bool
    {
        return !empty($this->getFirstLevel());
    }


    private function allChildrenHaveParent(): bool
    {
        foreach ($this->list as $item) {
            if ($item['parent'] === 0) continue;
            if (!$this->itemExists($item['parent'])) return false;
        }
        return true;
    }


    public function isListValid(): bool
    {
        return $this->listHasFirstLevel() && $this->allChildrenHaveParent();
    }


    private function hasChildren(int $parentId): bool
    {
        foreach ($this->list as $item) {
            if ($item['parent'] === $parentId) return true;
        }
        return false;
    }


    private function itemExists(int $id): bool
    {
        return array_key_exists($id, $this->list);
    }


    private function getItemLevel(int $itemId, int $level = 1): int
    {
        if ($this->list[$itemId]['parent'] !== 0) {
            $level = $this->getItemLevel($this->list[$itemId]['parent'], $level + 1);
        }
        return $level;
    }


    public function findFirst(string $value): ?int
    {
        foreach ($this->list as $id => $item) {
            if ($item['value'] === $value) {
                return $this->getItemLevel($id);
            }
        }
        return null;
    }


    public function search(string $value): array
    {
        $foundItems = [];
        foreach ($this->list as $id => $item) {
            if ($item['value'] === $value) {
                $foundItems[$id] = array_merge(
                    $item,
                    ['level' => $this->getItemLevel($id)]
                );
            }
        }
        return $foundItems;
    }


    public function moveItem(int $itemId, int $parentId): bool
    {
        if (
            !$this->itemExists($itemId)
            || !$this->itemExists($parentId)
            || $this->isItemInChildrenOf($parentId, $itemId) # new parent is in children of item
        ) {
            return false;
        }
        $this->list[$itemId]['parent'] = $parentId;
        return true;
    }


    private function deepSearch(int $needle, array $haystackList): bool
    {
        $found = false;
        foreach ($haystackList as $id => $item) {
            if ($this->hasChildren($id)) {
                $found = $this->deepSearch($needle, $this->getChildrenOf($id));
            }
            if ($needle === $id) return true;
        }
        return $found;
    }


    private function isItemInChildrenOf(int $itemId, int $parentItemId): bool
    {
        return $this->deepSearch($itemId, $this->getChildrenOf($parentItemId));
    }


    private function printBranch(array $branchList, int $level = 0)
    {
        foreach ($branchList as $id => $item) {
            echo str_repeat(' ', $level * 4) . '- [' . $id . '] ' . $item['value'] . "\n";
            if ($this->hasChildren($id)) {
                $this->printBranch($this->getChildrenOf($id), $level + 1);
            }
        }
    }


    public function printTree()
    {
        $this->printBranch($this->getFirstLevel());
    }
}